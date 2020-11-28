import { checkLoggedIn, logOut } from "./utils/auth";

export default {
       state: {
        isLoggedIn: false,
        user: {},
       },
       mutations: {
        addUser(state, payload) {
            state.user = payload;
        },
        setIsLoggedIn(state, payload) {
            state.isLoggedIn = payload;
        }
       },
       actions: {
           loadState({commit}) {
           commit('setIsLoggedIn', checkLoggedIn());
           },
        async checkUser({commit, dispatch}) {
            if (checkLoggedIn()) {
                try {
                    const user = (await axios.get('/user')).data;
                    commit("addUser", user);
                    commit("setIsLoggedIn", true);
                } catch (error) {
                    dispatch("logout");
                }
            }
        },
        logout({commit}) {
            commit("addUser", {});
            commit("setIsLoggedIn", false);
            logOut();
        }
       }
}