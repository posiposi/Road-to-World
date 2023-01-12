/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';
import AsyncComment from './components/AsyncComment.vue';
import HowToSection from './components/HowToSection.vue';
import MainPageVisual from './components/MainPageVisual.vue';
import FullCalendarComponent from './components/FullCalendarComponent.vue';
import MyBike from './components/MyBike.vue'

createApp({
    components:{
        AsyncComment,
        HowToSection,
        FullCalendarComponent,
        MainPageVisual,
        MyBike,
    }
}).mount('#app')
