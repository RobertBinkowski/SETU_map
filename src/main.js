import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

import "./assets/root.scss";

const app = createApp(App);

app.use(router);

app.mount("#app");
