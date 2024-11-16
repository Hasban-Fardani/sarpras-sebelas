import { User, UserLogin } from "./user";

export interface AuthState {
  user: User | null;
  isAuthenticated: boolean;
  loading: boolean;
  error: string | null;
  login: ({nip, password}: UserLogin ) => Promise<void>;
  logout: () => Promise<void>;
  fetchUser: () => Promise<void>;
}
