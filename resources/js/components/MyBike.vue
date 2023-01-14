<template>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col" v-for="(userBike) in userBikes" :key="image">
      <div class="card">
        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
          <img :src="userBike.image_path" class="img-fluid" alt="自転車画像" />
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ userBike.brand }}</h5>
          <p class="card-text">{{ userBike.remark }}</p>
          <button @click="redirectBikesEdit(userBike.id)" class="btn btn-primary">情報変更</button>
          <!-- <a href="#" class="btn btn-danger ms-2">削除</a> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";

export default {
  props: ['user_bikes'],
  setup(props) {
    // ユーザーの全所有自転車
    const userBikes = ref(props.user_bikes);

    // 自転車情報変更画面へのリダイレクトAPI呼び出し
    const redirectBikesEdit = (e) => {
      location.href = '/' + 'bikes' + '/' + e + '/' + 'edit';
    }

    return {
      userBikes,
      redirectBikesEdit,
    };
  }
}
</script>