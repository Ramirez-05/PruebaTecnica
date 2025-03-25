import { useRouter } from 'vue-router';
import { useAuthStore } from '../store/authStore';
import { useNotifications } from './useNotifications';

export function useAuthGuard() {
  const router = useRouter();
  const authStore = useAuthStore();
  const { addNotification } = useNotifications();

  const requireAuth = async () => {
    if (!authStore.isAuthenticated) {
      console.log('Usuario no autenticado, redirigiendo a login');
      router.push('/login');
      return false;
    }

    console.log('Usuario autenticado:', authStore.userId);
    
    if (!authStore.userName) {
      try {
        console.log('Cargando datos de usuario');
        await authStore.fetchUserData();
      } catch (error) {
        console.error('Error loading user data:', error);
        return true;
      }
    }

    return true;
  };

  const checkAuthAndRedirect = async (route) => {
    const isAuthed = await requireAuth();
    if (!isAuthed) {
      router.push({
        path: '/login',
        query: { redirect: route.fullPath }
      });
    }
    return isAuthed;
  };

  return {
    requireAuth,
    checkAuthAndRedirect
  };
} 