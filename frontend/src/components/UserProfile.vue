<template>
    <div class="container">
        <div id="app5" v-for="borrowbooks in borrowbooks" :key="borrowbooks.id">
            <div class="container">
                <div class="row" >
                    <div class="col-md-2 offset-md-1 app6">Image</div>
                    <div class="col app8">
                        <div class="app10">
                            <h5>Title : {{borrowbooks.Title}}</h5>
                            <h5>Genre : {{borrowbooks.Genre}}</h5>
                            <h5>Description : {{borrowbooks.Description}}</h5>
                            <h5>Price : Rs.{{borrowbooks.Price}}</h5>
                        </div>
                    </div>
                    <div class="app7">
                        <button type="button" class="btn btn-danger" @click="removeBooks($event)" v-bind:id="borrowbooks.bid">Remove</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                borrowbooks:[],
            }
        },
        created(){
            this.$http.get("http://localhost:8000/api/getborrowbooks")
                .then(function(response) {
                    this.borrowbooks = response.body.bookstoreuser;
                })
        
        },
        methods:{
        removeBooks(){
            this.$http.delete("http://localhost:8000/api/remove/" +event.target.id)
            .then(function(response) {
                
                var position = this.borrowbooks.findIndex( function (element)
                {
                    return element.id == event.target.id;
                });

                this.borrowbooks.splice(position,1);
            })
        }
    }
    }
</script>

<style>

#app5{
    display: flex;
    margin-top:20px;
    background: #f8f9fa;
    width: 100%;
    height: 400px;
    border-radius: 8px;
    border: 2px solid black;
}

.app6{
    margin-top: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
    background: greenyellow;
}

.app7{
    display: flex;
    align-items: center;
    height: 70px;
    justify-content: right;
}

.app8{
    margin-top: 22px;
    margin-left: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
}

.app10{
    text-align: justify;
    width: 99%;
    height: 90%;
}
</style>