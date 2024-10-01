const express = require('express'); // Import Express
const WeatherApi = require('./src/weather_api');

const app = express();
const PORT = 8082;

app.get('/', async (req, res) => {
    const weatherResponse = await WeatherApi.forecast('Ho Chi Minh')
    res.send(weatherResponse);
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});