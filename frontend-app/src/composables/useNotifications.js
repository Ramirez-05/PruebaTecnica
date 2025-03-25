import { ref } from 'vue';

const notifications = ref([]);

export function useNotifications() {
  const addNotification = (message, type = 'info', timeout = 3000) => {
    const id = Date.now();
    notifications.value.push({ id, message, type });
    
    if (timeout) {
      setTimeout(() => {
        removeNotification(id);
      }, timeout);
    }
    
    console.log(`Notificación (${type}): ${message}`);
  };

  const removeNotification = (id) => {
    notifications.value = notifications.value.filter(n => n.id !== id);
  };

  return {
    notifications,
    addNotification,
    removeNotification
  };
} 