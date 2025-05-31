**🌐 Real-World Example: Adapting External API Response**
**🛰️ API Response (Adaptee)**

```js
const weatherAPIResponse = {
  temp_celsius: 28,
  wind_kph: 10,
  city: 'Mumbai'
};

```

**🌦️ Target Interface (What your app expects)**

```js
// App expects:
{
  temperature: 28,
  windSpeed: 10,
  location: 'Mumbai'
}

```

**🔧 Adapter Function**

```js
function adaptWeatherResponse(apiResponse) {
  return {
    temperature: apiResponse.temp_celsius,
    windSpeed: apiResponse.wind_kph,
    location: apiResponse.city
  };
}

const adapted = adaptWeatherResponse(weatherAPIResponse);
console.log(adapted);
// Output: { temperature: 28, windSpeed: 10, location: 'Mumbai' }

```

**🛠️ Advanced Usage: Adapter Class for Multiple APIs**

```js
class WeatherAdapter {
  constructor(apiResponse, source) {
    this.apiResponse = apiResponse;
    this.source = source;
  }

  getStandardFormat() {
    if (this.source === 'WeatherAPI') {
      return {
        temperature: this.apiResponse.temp_celsius,
        windSpeed: this.apiResponse.wind_kph,
        location: this.apiResponse.city
      };
    } else if (this.source === 'OpenWeatherMap') {
      return {
        temperature: this.apiResponse.main.temp,
        windSpeed: this.apiResponse.wind.speed,
        location: this.apiResponse.name
      };
    }

    throw new Error('Unsupported weather source');
  }
}

```

**✅ Usage:**

```js
const weather1 = new WeatherAdapter(weatherAPIResponse, 'WeatherAPI');
console.log(weather1.getStandardFormat());

const weather2 = new WeatherAdapter(openWeatherResponse, 'OpenWeatherMap');
console.log(weather2.getStandardFormat());

```

**✅ Benefits of Adapter in JavaScript**

| Benefit                | Description                                    |
| ---------------------- | ---------------------------------------------- |
| Decouples code         | From third-party/legacy implementations        |
| Enables reusability    | Wrap any interface into a reusable component   |
| Makes testing easier   | By mocking target interfaces                   |
| Supports extensibility | Add more adapters without changing client code |


**🚨 Things to Avoid**
- Don’t overuse adapters for everything. If you control both interfaces, just refactor them.
- Adapter doesn’t fix a bad interface — it isolates it.

**🧩 Adapter Pattern Variants in JS**
- Class-based Adapter (via ES6 classes and composition).
- Function-based Adapter (simple functional transformation).
- Interface Shim (used in Node.js modules or APIs).