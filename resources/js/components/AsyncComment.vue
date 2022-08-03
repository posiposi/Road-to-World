<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card initsender">
                    <div class="card-header">
                        <p>{{ data.sender.nickname }}</p>
                    </div>
                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { ref } from "vue";
    export default {
        props:['data'],
        setup(props) {
            const data = ref(props.data);
            console.log(props.data);

            return {
                data
            };
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>    
