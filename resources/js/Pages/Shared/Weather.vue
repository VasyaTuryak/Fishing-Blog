<script>

import axios from "axios";
import Layout from "@/Pages/Shared/Layout.vue";
import {Head} from "@inertiajs/vue3";

export default {
    components: {Head, Layout},
    props:{
        levelOfWaterInRiver: String,
        date: String
    },
    data() {
        return {
            currentPosition: 'Puzhivka',
            currentLocationKey: 1208007,
            dropDownList: 'Choose location for fishing:',
            HTML:'Connect to <b>AccuWeather API</b> through AXIOS get weather condition',
            WeatherArray: '',
            fiveDays: 'http://dataservice.accuweather.com/forecasts/v1/daily/5day/1208007?apikey=NzqkfdM7AhwLN9El2voJ3R72O0kCnnbE&metric=true',
            points: {
                Puzhivka: 1208007,
                Rudkivzi: 1207484,
                Kurazun: 1213403,
                Gubariv: 1216426,
                StaraUshuicya: 324081,
                Vrublivtci: 1203047,
                Glumbivka: 1216962
            }
        }
    },
    watch: {
        currentPosition() {
            this.changeLocation
        },

    },
    computed: {
        changeLocation() {
            this.WeatherArray = ''
            if (this.currentPosition !== 'Puzhivka') {
                this.currentLocationKey = this.points[this.currentPosition]
                this.fiveDays = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/" + this.currentLocationKey + "?apikey=NzqkfdM7AhwLN9El2voJ3R72O0kCnnbE&metric=true"
            }
            if (this.currentPosition == 'Puzhivka') {
                this.fiveDays = 'http://dataservice.accuweather.com/forecasts/v1/daily/5day/1208007?apikey=NzqkfdM7AhwLN9El2voJ3R72O0kCnnbE&metric=true',
                    this.currentLocationKey = 1208007
            }
        }
    },
    beforeMount() {
        this.GetData(this.fiveDays)
    },
    methods: {
        formNewUrl(number) {
            if (number < 10) {
                return "https://developer.accuweather.com/sites/default/files/" + 0 + number + "-s.png";
            } else {
                return "https://developer.accuweather.com/sites/default/files/" + number + "-s.png";
            }
        },
        newData() {
            this.GetData(this.fiveDays)
        },
        GetData(url) {
            axios
                .get(url)
                .then(response => {
                    this.WeatherArray = response.data.DailyForecasts
                })
                .catch((error => {
                        console.log('something wrong happened')
                        console.log(error)
                    }
                ))
        }
    }
}

</script>
<template>
    <div>
        <Layout>
            <Head>
                <title>Weather</title>
            </Head>
            <div>
                <div class="flex justify-center">
                    <div class="flex flex-col ">
                        <div v-if="levelOfWaterInRiver" class="border-2">
                            <p>Level of water in Dnister near Zalischiki: {{levelOfWaterInRiver}} cm., data from {{date}}</p>
                            <p>Parse data from site:</p>
                            <a href="http://dnister.meteo.gov.ua/ua/hydro_operational_data" class="hover:text-blue-700">http://dnister.meteo.gov.ua/ua/hydro_operational_data</a>
                        </div>

                        <br>
                        <p v-html="HTML"></p>
                        <br>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="flex flex-col mb-8">
                        <p v-text="dropDownList"></p>
                        <br>
                        <select class="flex w-1/12flex-row justify-center" v-model="currentPosition"
                                @click.prevent="newData">
                            <option v-for="(x,index) in points" :value=index :key="points.index">{{ index }}</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-row justify-evenly ml-2 mr-2">
                    <div v-for="DayWeather in WeatherArray">
                        <div class="flex flex-col">
                            <br>
                            <h1><b>Data: {{ DayWeather.Date.slice(0, 10) }}</b></h1>
                            <p>Temperature maximum: {{ DayWeather.Temperature.Maximum.Value }}</p>
                            <p>Temperature minimum: {{ DayWeather.Temperature.Minimum.Value }}</p>
                            <br>
                            <p><b>Day</b></p>
                            <p v-if="DayWeather.Day.HasPrecipitation">
                                <p>Description: {{ DayWeather.Day.PrecipitationType }}</p>
                                <p>Intensity: {{ DayWeather.Day.PrecipitationIntensity }}</p>
                            </p>
                            <p v-else>
                                <p>Without Precipitation. </p>
                                <p>{{ DayWeather.Day.IconPhrase }}</p>
                            </p>
                            <img :src="formNewUrl(DayWeather.Day.Icon )" alt="DayIcon" class="max-w-28">
                            <br>
                            <p><b>Night</b></p>
                            <p v-if="DayWeather.Night.HasPrecipitation">
                                <p>Description: {{ DayWeather.Night.PrecipitationType }}</p>
                                <p>Intensity: {{ DayWeather.Night.PrecipitationIntensity }}</p>
                            </p>
                            <p v-else>
                                <p>Without Precipitation. </p>
                                <p>{{ DayWeather.Night.IconPhrase }}</p>
                            </p>
                            <img :src="formNewUrl(DayWeather.Night.Icon )" alt="NightIcon" class="max-w-28">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    </div>
</template>

<style scoped>

</style>
