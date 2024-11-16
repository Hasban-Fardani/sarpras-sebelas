import axios from "@/lib/axios";
import { AuthState } from "@/types/auth";
import { UserLogin } from "@/types/user";
import { create } from "zustand";


const useAuthStore = create<AuthState>((set) => ({
  token: "",
  user: null,
  loading: false,
  isAuthenticated: false,
  error: null,
  
  login: async ({nip, password}: UserLogin) => {
    set({loading: true});

    try {
      await axios.get(`/`);
      await axios.post(`/auth/login`, {nip, password});

      const { data } = await axios.get('/auth/user');
      set({ user:data, isAuthenticated: true, loading: false });
    } catch (err: any) {
      
    }
  },

  logout: async () => {
    set({ loading: true });
    try {
      await axios.post('/auth/logout');
      set({ user: null, isAuthenticated: false, loading: false});
    } catch (err: any) {
      set({
        error: err.response?.data?.message || 'Logout failed',
        loading: false
      })
    }
  },

  fetchUser: async() => {
    set({ loading: true });
    try {
      const { data } = await axios.get('/auth/user');
      set({ user: data, isAuthenticated: true, loading: false });
    } catch (err) {
      set({ user: null, isAuthenticated: false, loading: false });
    }
  }
}));

export default useAuthStore;
