from flask import Flask, jsonify 
from src import WeatherApi  

app = Flask(__name__)

@app.route('/')
def index():
    try:
        # init class
        weather_api = WeatherApi("073922d575msh362e38820e8e6e2p129d8fjsn3537b7039650")

        weather_data = weather_api.call('Ho Chi Minh', 'VI')
        return jsonify(weather_data)
    except Exception as e:
        return str(e), 500

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=8080)