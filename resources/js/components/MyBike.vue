<template>
    <div class="row">
        <div class="card col-sm-4 mt-3" v-for="(userBike) in userBikes" :key="image">
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img :src="userBike.image_path" class="img-fluid" alt="自転車画像" />
                <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ userBike.brand }}</h5>
                <p class="card-text">{{ userBike.remark }}</p>
                <a href="#!" class="btn btn-primary">Button</a>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";

export default {
    props:['user_bikes'],
    setup(props) {
        // ユーザーの全所有自転車
        const userBikes = ref(props.user_bikes);

        return {
            userBikes,
        }
    }
}
</script>