<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const consentStatus = ref({
  necessaries: true,
  analitiques: false,
  marqueting: false
});

const cookieTypes = [
  { 
    nom: 'Cookies Necessàries',
    descripcio: 'Cookies essencials per al funcionament bàsic del lloc web',
    key: 'necessaries',
    obligatori: true
  },
  { 
    nom: 'Cookies Analítiques',
    descripcio: 'Cookies que ens ajuden a entendre com interactues amb el lloc web',
    key: 'analitiques',
    obligatori: false
  },
  { 
    nom: 'Cookies de Màrqueting',
    descripcio: 'Cookies utilitzades per personalitzar publicitat i seguiment',
    key: 'marqueting',
    obligatori: false
  }
];

const mostrarBanner = ref(true);
const mostrarConfiguracio = ref(false);

const preventNavigation = (e) => {
  if (mostrarBanner.value) {
    e.preventDefault();
    e.returnValue = '';
    return 'Has d\'acceptar o rebutjar les cookies abans de continuar.';
  }
};

const guardarPreferencies = () => {
  localStorage.setItem('cookieConsent', JSON.stringify(consentStatus.value));
  mostrarBanner.value = false;
  mostrarConfiguracio.value = false;
  window.removeEventListener('beforeunload', preventNavigation);
};

const acceptarTotes = () => {
  consentStatus.value = {
    necessaries: true,
    analitiques: true,
    marqueting: true
  };
  guardarPreferencies();
};

const rebutjarTotes = () => {
  consentStatus.value = {
    necessaries: true,
    analitiques: false,
    marqueting: false
  };
  guardarPreferencies();
};

onMounted(() => {
  const guardat = localStorage.getItem('cookieConsent');
  if (guardat) {
    consentStatus.value = JSON.parse(guardat);
    mostrarBanner.value = false;
  } else {
    window.addEventListener('beforeunload', preventNavigation);
    
    // Bloquear clicks en enlaces
    document.addEventListener('click', (e) => {
      if (mostrarBanner.value && e.target.tagName === 'A') {
        e.preventDefault();
      }
    }, true);
  }
});

onBeforeUnmount(() => {
  window.removeEventListener('beforeunload', preventNavigation);
});
</script>

<template>
  <div v-if="mostrarBanner" class="cookie-banner">
    <div class="banner-content">
      <h3 class="text-black">🍪 Gestió de Cookies</h3>
      <p class="text-black">Has d'acceptar o rebutjar les cookies abans de continuar navegant.</p>
      
      <div class="banner-actions">
        <button @click="acceptarTotes" class="btn-acceptar">Acceptar Totes</button>
        <button @click="mostrarConfiguracio = true" class="btn-configurar">Configurar</button>
        <button @click="rebutjarTotes" class="btn-rebutjar">Rebutjar Totes</button>
      </div>
    </div>
  </div>

  <div v-if="mostrarConfiguracio" class="cookie-configuracio-overlay">
    <div class="cookie-configuracio">
      <h3 class="text-black">Configuració de Cookies</h3>
      <div v-for="tipus in cookieTypes" :key="tipus.key" class="tipus-cookie">
        <label>
          <input 
            type="checkbox" 
            :checked="consentStatus[tipus.key]" 
            :disabled="tipus.obligatori"
            @change="consentStatus[tipus.key] = !consentStatus[tipus.key]"
          >
          <p class="text-black">{{ tipus.nom }}</p>
        </label>
        <p class="text-black">{{ tipus.descripcio }}</p>
      </div>
      <div class="configuracio-actions">
        <button @click="guardarPreferencies" class="btn-guardar">Guardar Preferències</button>
        <button @click="mostrarConfiguracio = false" class="btn-cancelar">Cancel·lar</button>
      </div>
    </div>
  </div>

  <div v-if="mostrarBanner" class="overlay-bloqueig"></div>
</template>

<style scoped>
.cookie-banner {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: rgba(248, 249, 250, 0.98);
  border-top: 2px solid #007bff;
  box-shadow: 0 -4px 6px rgba(0,0,0,0.1);
  padding: 20px;
  z-index: 1000;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.overlay-bloqueig {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 999;
  cursor: not-allowed;
}

.banner-content, .cookie-configuracio {
  max-width: 800px;
  width: 90%;
}

.banner-actions, .configuracio-actions {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-top: 15px;
  width: 100%;
}

.btn-acceptar, .btn-guardar {
  background-color: #28a745;
  color: white;
}
.btn-configurar {
  background-color: #007bff;
  color: white;
}
.btn-rebutjar, .btn-cancelar {
  background-color: #dc3545;
  color: white;
}

button {
  padding: 12px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 16px;
  min-width: 120px;
}

button:hover {
  opacity: 0.9;
  transform: translateY(-2px);
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.cookie-configuracio-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1100;
  padding: 20px;
}

.cookie-configuracio {
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  max-width: 600px;
  width: 100%;
  padding: 30px;
  position: relative;
  animation: slideDown 0.3s ease;
}

.btn-tancar {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #dc3545;
  min-width: auto;
  padding: 0;
  transition: color 0.3s ease;
}

.btn-tancar:hover {
  color: #a71d2a;
  transform: none;
  box-shadow: none;
}

.tipus-cookie {
  margin-bottom: 15px;
  padding: 15px;
  background-color: #f1f3f5;
  border-radius: 5px;
  width: 100%;
}

.tipus-cookie label {
  display: flex;
  align-items: center;
  font-weight: bold;
}

.tipus-cookie input[type="checkbox"] {
  margin-right: 10px;
  width: 18px;
  height: 18px;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 600px) {
  .banner-actions, .configuracio-actions {
    flex-direction: column;
    align-items: center;
  }

  button {
    width: 100%;
    margin-bottom: 10px;
  }

  .cookie-configuracio {
    width: 95%;
    padding: 20px;
  }
}
</style>
