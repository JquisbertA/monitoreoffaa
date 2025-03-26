<template>
  <div class="map-page">
    <!-- Encabezado y controles... (mantén tu código actual) -->
    
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Mapa de Localizaciones</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="map-controls">
              <button @click="addingMarker = !addingMarker" 
                      :class="['btn', addingMarker ? 'btn-danger' : 'btn-success']">
                {{ addingMarker ? 'Cancelar' : 'Añadir Punto' }}
              </button>
            </div>
            
            <div class="map-container">
              <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

      
    <!-- Modal actualizado para incluir imagen -->
    <div v-if="showLocationModal" class="modal fade show" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ editingLocation ? 'Editar' : 'Añadir' }} Localización</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nombre</label>
              <input v-model="currentLocation.name" class="form-control">
            </div>
            <div class="form-group">
              <label>Descripción</label>
              <textarea v-model="currentLocation.description" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label>Imagen</label>
              <input type="file" ref="imageInput" @change="handleImageUpload" class="form-control">
              <img v-if="currentLocation.image_url" :src="currentLocation.image_url" 
                  style="max-width: 100px; margin-top: 10px;">
            </div>
          </div>
          <div class="modal-footer">
            <button @click="showLocationModal = false" class="btn btn-secondary">Cancelar</button>
            <button @click="saveLocation" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal actualizado para incluir imagen -->
    <div v-if="showLocationModal" class="modal fade show" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ editingLocation ? 'Editar' : 'Añadir' }} Localización</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nombre</label>
              <input v-model="currentLocation.name" class="form-control">
            </div>
            <div class="form-group">
              <label>Descripción</label>
              <textarea v-model="currentLocation.description" class="form-control"></textarea>
            </div>

            <div v-if="currentLocation.image_url && !currentLocation.remove_image">
              <img :src="currentLocation.image_url" style="max-height: 100px;">
              <button @click="removeExistingImage" type="button">
                Eliminar imagen
              </button>
            </div>
            <div class="form-group">
              <label>Imagen</label>
              <input type="file" ref="imageInput" @change="handleImageUpload" class="form-control">
              <img v-if="currentLocation.image_url" :src="currentLocation.image_url" 
                  style="max-width: 100px; margin-top: 10px;">
            </div>


          </div>
          <div class="modal-footer">
            <button @click="showLocationModal = false" class="btn btn-secondary">Cancelar</button>
            <button @click="updateMarker" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default {
  data() {
    return {
      map: null,
      markers: [],
      locations: [], // Añade este array para almacenar las ubicaciones
      addingMarker: false,
      showLocationModal: false,
      currentLocation: {
        name: '',
        description: '',
        lat: 0,
        lng: 0,
        image: null,
        image_url: null
      },
      editingLocation: null
    }
  },
  mounted() {
    // Solución para iconos rotos
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
      iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
      iconUrl: require('leaflet/dist/images/marker-icon.png'),
      shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
    });
    
    window.vueApp = this;
    this.initMap();
    this.loadLocations();
  },
  methods: {
    initMap() {
      this.$nextTick(() => {
        this.map = L.map('map', {
          center: [-16.5, -68.1],
          zoom: 6,
          minZoom: 5,
          maxZoom: 18
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(this.map);

        this.map.on('click', (e) => {
          if (this.addingMarker) {
            this.currentLocation.lat = e.latlng.lat;
            this.currentLocation.lng = e.latlng.lng;
            this.showLocationModal = true;
            this.addingMarker = false;
          }
        });
      });
    },

    async loadLocations() {
      try {
        const response = await axios.get('/locations');
        this.locations = response.data; // Almacena las ubicaciones
        this.updateMarkers();
      } catch (error) {
        console.error('Error loading locations:', error);
      }
    },

    updateMarkers() {
      // Limpiar marcadores existentes
      this.markers.forEach(marker => this.map.removeLayer(marker));
      this.markers = [];
      
      // Configurar el icono (solución para iconos rotos)
      const defaultIcon = L.icon({
        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
        iconRetinaUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-2x.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });

      // Crear nuevos marcadores
      this.markers = this.locations.map(location => {
        const marker = L.marker([location.lat, location.lng], {
          icon: defaultIcon
        })
        .bindPopup(this.getPopupContent(location))
        .addTo(this.map);
        
        marker.locationId = location.id;
        return marker;
      });
    },

    getPopupContent(location) {
      const imageUrl = location.image_path || location.image_url;
      return `
        <div style="
          text-align: center; 
          font-family: Arial, sans-serif; 
          max-width: 200px;
        ">
          <strong style="
            display: block; 
            font-size: 14px; 
            margin-bottom: 5px; 
            color: #333;
          ">${location.name}</strong>
          
          ${location.description ? `
            <p style="
              margin: 5px 0; 
              color: #666; 
              font-size: 12px;
            ">${location.description}</p>
          ` : ''}
          
          ${imageUrl ? `
            <div style="
              width: 150px; 
              height: 100px; 
              margin: 5px auto; 
              overflow: hidden;
              display: flex;
              align-items: center;
              justify-content: center;
              background: #f5f5f5;
              border-radius: 4px;
            ">
              <img src="${imageUrl}" 
                  style="
                    max-width: 100%; 
                    max-height: 100%; 
                    object-fit: contain;
                  ">
            </div>
          ` : ''}
          
          <button onclick="window.vueApp.editMarker(${location.id})" 
                  style="
                    padding: 3px 8px;
                    font-size: 12px;
                    background: #3490dc;
                    color: white;
                    border: none;
                    border-radius: 3px;
                    cursor: pointer;
                    margin-top: 5px;
                  ">
            Editar
          </button>
          <button onclick="window.vueApp.deleteMarker(${location.id})" 
                style="padding: 3px 8px; font-size: 12px; background: #e3342f; color: white; 
                      border: none; border-radius: 3px; cursor: pointer;">
            Eliminar
          </button>
        </div>
      `;
    },

    editMarker(id) {
      const location = this.locations.find(l => l.id === id);
      if (location) {
        this.currentLocation = { 
          ...location,
          image: null,
          image_url: location.image_path || null,
          remove_image: false
        };
        this.editingLocation = location;
        this.showLocationModal = true;
        
        // Centrar el mapa en el marcador
        this.map.flyTo([location.lat, location.lng], this.map.getZoom(), {
          duration: 0.5
        });
      }
    },

    removeExistingImage() {
      this.currentLocation.image_url = null;
      this.currentLocation.remove_image = true;
      this.$toast.info('Imagen marcada para eliminar');
    },

    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.currentLocation.image = file;
        this.currentLocation.image_url = URL.createObjectURL(file);
      }
    },

    async saveLocation() {
      const formData = new FormData();
      formData.append('name', this.currentLocation.name);
      formData.append('description', this.currentLocation.description);
      formData.append('lat', this.currentLocation.lat);
      formData.append('lng', this.currentLocation.lng);
      
      if (this.currentLocation.image) {
        formData.append('image', this.currentLocation.image);
      }

      try {
        const url = this.editingLocation 
          ? `/locations/${this.editingLocation.id}`
          : '/locations';
        
        const method = this.editingLocation ? 'put' : 'post';
        
        await axios[method](url, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });
        
        this.loadLocations(); // Recargar los datos
        this.showLocationModal = false;
        this.resetCurrentLocation();
      } catch (error) {
        console.error('Error saving location:', error);
      }
    },

    resetCurrentLocation() {
      this.currentLocation = { 
        name: '', 
        description: '', 
        lat: 0, 
        lng: 0,
        image: null,
        image_url: null
      };
      if (this.$refs.imageInput) {
        this.$refs.imageInput.value = '';
      }
    },
  
    beforeDestroy() {
      if (this.map) {
        this.map.remove();
      }
    },
    addMarkers(locations) {
    // Configurar el icono por defecto
      const defaultIcon = L.icon({
        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
        iconRetinaUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-2x.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });

      this.markers = locations.map(location => {
        const marker = L.marker([location.lat, location.lng], {
          icon: defaultIcon // Asignar el icono configurado
        })
        .bindPopup(this.getPopupContent(location))
        .addTo(this.map);
        
        marker.locationId = location.id;
        return marker;
      });
    },

    async updateMarker() {
      try {
        // Validación básica
        if (!this.currentLocation.name || !this.currentLocation.lat || !this.currentLocation.lng) {
          this.$toast.warning('Por favor complete todos los campos requeridos');
          return;
        }

        const formData = new FormData();
        formData.append('_method', 'PUT'); // Cambiado a PUT (correcto para actualización)
        formData.append('name', this.currentLocation.name);
        formData.append('description', this.currentLocation.description || '');
        formData.append('lat', this.currentLocation.lat);
        formData.append('lng', this.currentLocation.lng);
        
        if (this.currentLocation.image) {
          formData.append('image', this.currentLocation.image);
        }

        // Bandera para eliminar imagen existente
        if (this.currentLocation.remove_image) {
          formData.append('remove_image', 'true'); // Enviar como string
        }

        // Cambiar a PUT o PATCH según tu ruta Laravel
        const response = await axios.post(
          `/mapa-ceos/${this.editingLocation.id}`, // Asegúrate que la ruta coincida
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
        );

        // Configurar icono seguro
        const defaultIcon = new L.Icon.Default();

        // Actualización local sin recargar
        const index = this.locations.findIndex(l => l.id === this.editingLocation.id);
        if (index !== -1) {
          this.locations[index] = response.data;
          
          // Actualizar marcador en el mapa
          const markerIndex = this.markers.findIndex(m => m.locationId === this.editingLocation.id);
          if (markerIndex !== -1) {
            this.map.removeLayer(this.markers[markerIndex]);
            

            const newMarker = L.marker(
              [response.data.lat, response.data.lng],
              { 
                icon: new L.Icon.Default() // Usa el icono configurado
              }
            )
            .bindPopup(this.getPopupContent(response.data))
            .addTo(this.map);
            
            newMarker.locationId = response.data.id;
            this.markers[markerIndex] = newMarker;
          }
        }

        // Cerrar modal y resetear
        this.showLocationModal = false;
        this.resetCurrentLocation();
        this.$toast.success('Marcador actualizado correctamente');
      } catch (error) {
        console.error('Error completo:', error);
        this.$toast.error(error.response?.data?.message || 'Error al actualizar');
      }
    },

    async deleteMarker(id) {
      if (confirm('¿Estás seguro de que quieres eliminar este marcador?')) {
        try {
          await axios.delete(`/locations/${id}`);
          
          // Eliminar el marcador del mapa
          const markerIndex = this.markers.findIndex(m => m.locationId === id);
          if (markerIndex !== -1) {
            this.map.removeLayer(this.markers[markerIndex]);
            this.markers.splice(markerIndex, 1);
          }
          
          // Eliminar la ubicación del array
          const locationIndex = this.locations.findIndex(l => l.id === id);
          if (locationIndex !== -1) {
            this.locations.splice(locationIndex, 1);
          }
          
          this.$toast.success('Marcador eliminado correctamente');
        } catch (error) {
          console.error('Error al eliminar el marcador:', error);
          this.$toast.error('Error al eliminar el marcador');
        }
      }
    }
  },
}
</script>



<style scoped>
  .leaflet-marker-icon {
    display: block !important;
  }
  .map-container {
    height: 500px;
    width: 100%;
    position: relative;
    z-index: 1;
  }

  #map {
    height: 100%;
    width: 100%;
  }

  .map-controls {
    margin-bottom: 15px;
  }

  /* Estilos para el modal */
  .modal {
    background: rgba(0,0,0,0.5);
  }


  /* En tu archivo de estilos */
  .leaflet-popup-content {
    font-size: 12px; /* Tamaño más pequeño para el texto */
  }

  .leaflet-popup-content strong {
    font-size: 14px; /* Tamaño un poco mayor para el nombre */
  }

  .leaflet-popup-content p {
    margin: 5px 0;
    font-size: 12px;
  }

  .leaflet-popup-content img {
    max-width: 100px;
    margin: 5px 0;
  }








  .map-popup {
    text-align: center;
    font-size: 12px;
    padding: 8px;
    max-width: 250px; /* Ancho máximo del popup */
  }

  .popup-title {
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
    display: block;
  }

  .popup-desc {
    margin: 5px 0;
    color: #666;
    font-size: 12px;
  }

  .img-container {
    margin: 8px 0;
    overflow: hidden; /* Para contener la imagen */
    border-radius: 4px;
    background: #f5f5f5; /* Fondo para imágenes con transparencia */
  }

  .popup-img {
    max-width: 150px;
    max-height: 100px;
    width: auto;
    height: auto;
    display: block;
    margin: 0 auto;
    border-radius: 3px;
    object-fit: contain; /* Mantiene la relación de aspecto */
  }

  .popup-btn {
    padding: 3px 8px;
    font-size: 12px;
    background: #3490dc;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    margin-top: 5px;
  }
</style>