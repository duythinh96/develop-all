const axios = require('axios');
const env = require('../../config/env.json');

class WeatherApiClass {
    async forecast(city) {
        const url = `https://${env.api.host}/city/` + encodeURIComponent(city) + '/EN';
        const options = {
            headers: {
                'x-rapidapi-host': env.api.host,
                'x-rapidapi-key': env.api.api_token,
            },
        };

        const res = "";
    
        try {
            const response = await axios.get(url, options)
            return "OK:" + JSON.stringify(response, null, 2)
        } catch (error) {
            console.log(error.response)
            return "ERROR" + JSON.stringify(error.message)
        }
    }
}

const WeatherApi = new WeatherApiClass();

module.exports = WeatherApi;