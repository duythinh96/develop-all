import requests
import json

class WeatherApi:
    def __init__(self, apikey):
        host = ""
        api_token = ""

        # Get Config
        file_path = '../../config/env.json'
        with open(file_path, 'r') as file:
            data = json.load(file)
            host = data["api"]["host"]
            api_token = data["api"]["api_token"]

        # Set attribute
        self.url = "https://{host}/"
        self.headers = {
            "x-rapidapi-host": api["host"],
            "x-rapidapi-key": api_token, 
        }

    def formatResponse(self, json):
        try:
            name = json["name"]
            country = json["sys"]["country"]
            description = json["weather"][0]["description"] 

            t = json["main"]["temp"]
            temp = round(5 * (t - 32) / 9, 1)
            temMin = json["main"]["temp_min"]
            tempMin =round( 5 * (temMin - 32) / 9, 1)
            temMax = json["main"]["temp_max"]
            tempMax = round(5 * (temMax - 32) / 9, 1)

            return  { "data": f"\nThời tiết hiện tại của {name} ({country}) là {description}.\nNhiệt độ {temp}°C ({tempMin}°C - {tempMax}°C)" } 
            #return json
        except KeyError as e:
            return { "error": f"Lỗi: Thiếu khóa {e}" }
        except Exception as e:
            return  { "error": f"Đã xảy ra lỗi: {e}" }

    def call(self, city, lang):
        url = self.API_URL + "/city/" + city + "/" + lang
        response = requests.get(url, headers=self.headers)
        if response.status_code == 200:
            return self.formatResponse(response.json())
        else:
            return f"Error: {response.status_code}, {response.text}"
