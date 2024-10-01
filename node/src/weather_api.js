const axios = require('axios');

class WeatherApiClass {
    async forecast(city) {
        const url = 'https://open-weather13.p.rapidapi.com/city/' + encodeURIComponent(city) + '/EN';
        const options = {
            headers: {
                'x-rapidapi-host': 'open-weather13.p.rapidapi.com',
                'x-rapidapi-key': '073922d575msh362e38820e8e6e2p129d8fjsn3537b7039650',
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