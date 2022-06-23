let url;

if (process.env.APP_ENV === "local") url = "http://192.168.1.113:8000";
if (process.env.APP_ENV === "production") url = "https://correct-io.herokuapp.com";

export const BASE_URL = url;