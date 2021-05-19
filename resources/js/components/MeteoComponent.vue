<template>
    <div
        class="card"
        style=" background: #71e798d0;
                      color: white;
                      padding: 2em;
                      border-radius: 30px;
                      width: 90%;
                      height: 85%;
                      max-width: 420px;
                      margin: 1em;"
    >
        <div class="weather loading">
           
            <h2 class="city">Weather in {{ location }}</h2>
            <h1 class="temp">{{data.current.temp_c}} °C</h1>
            <div class="flex">
                <img
                    src="https://openweathermap.org/img/wn/04n.png"
                    alt=""
                    class="icon"
                />
                <div class="description">{{data.current.condition.text}}</div>
            </div>
            <div class="humidity">Humidity: {{data.current.humidity}}</div>
            <div class="wind">Wind speed: {{data.current.wind_kph}}km/h</div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["location"],
    data() {
        return {
            data: 
            {
               condition:{text:null},
               temp_c:null,
               humidity:null,
               wind_kph:null,
            }
        };
    },
    mounted() {
        console.log("Component mounted.");
        
        axios.get(
            `http://api.weatherapi.com/v1/forecast.json?key=b46134e867a34ae883d163825210905&q=${location}&days=1&aqi=no&alerts=no`
        ).then(response=>this.data=response.data).catch(error=>console.log(error));
    }
};
</script>
