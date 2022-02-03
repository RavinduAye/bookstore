<template>
    <div class="container">
        <div id="app2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">Book title</label>
            </div>
            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">Book description</label>
            </div>
            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">Genre</label>
            </div>

            <form class="d-flex">
                <input class="form-control me-2" type="text" v-model="search" placeholder="Search" aria-label="Search">
                <button @click.prevent="searchBooks()" class="btn btn-success">Search</i></button>
            </form>
        </div>

        <div v-if="showsearch==true">
            <div id="app5" v-for="searchbooks in searchbooks" :key="searchbooks.id" class="col-md-6">
                <div class="container">
                    <div class="row" >
                        <div class="col-md-2 offset-md-1 app6">Image</div>
                        <div class="col app8">
                            <div class="app10">
                                <h5>Title : {{searchbooks.Title}}</h5>
                                <h5>Genre : {{searchbooks.Genre}}</h5>
                                <h5>Description : {{searchbooks.Description}}</h5>
                                <h5>Price : Rs.{{searchbooks.Price}}</h5>
                            </div>
                        </div>
                        <div class="app7">
                            <button type="button" class="btn btn-success" @click="borrowBooks($event)" v-bind:id="searchbooks.id">Borrow</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showsearch==false">
            <div id="app5" v-for="books in pageOfItems" :key="books.id">
                <div class="container">
                    <div class="row" >
                        <div class="col-md-2 offset-md-1 app6">Image</div>
                        <div class="col app8">
                            <div class="app10">
                                <h5>Title : {{books.Title}}</h5>
                                <h5>Genre : {{books.Genre}}</h5>
                                <h5>Description : {{books.Description}}</h5>
                                <h5>Price : Rs.{{books.Price}}</h5>
                            </div>
                        </div>
                        <div class="app7">
                            <button type="button" class="btn btn-success" @click="borrowBooks($event)" v-bind:id="books.id">Borrow</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card text-center m-3">
                <div class="card-footer pb-0 pt-3">
                    <jw-pagination :pageSize=2 :items="books" @changePage="onChangePage"></jw-pagination>
                </div>
            </div> 
        </div>   
    </div>
</template>

<script>

export default {
    data(){
        return{
            books:[],
            search : '',
            searchbooks:[],
            pageOfItems: [],
        
            showsearch: false
        }
    },
    created(){
        this.$http.get("http://localhost:8000/api/getbooks")
            .then(function(response) {
                
                this.books = response.body.allbooks.map(allbooks => ({ 
                    id: allbooks.id, 
                    Title: allbooks.Title, 
                    Genre : allbooks.Genre,
                    Description :allbooks.Description,
                    Price : allbooks.Price
                    }));

            })
    
    },
    methods:{
        borrowBooks(){
            this.$http.delete("http://localhost:8000/api/borrow/" +event.target.id)
            .then(function(response) {
                
                var position = this.books.findIndex( function (element)
                {
                    return element.id == event.target.id;
                    
                });

                this.books.splice(position,1);
            
            })
        },
        onChangePage(pageOfItems) {
            console.log(pageOfItems)
            this.pageOfItems = pageOfItems;
        },

        searchBooks(){
            this.$http.get("http://localhost:8000/api/search?q=" +this.search)
            .then(response => response.json())
            .then(response => {
                this.searchbooks = response;
                this.search='';
                this.showsearch = true;
            })

            .catch(err => {
                console.log(err);
            });
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

#app2{
    height: 70px;
    text-align: right;
    font-size: 1.2pc;
    margin-top:10px;
    background-color: #e3f2fd;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

/* search bar size */
.d-flex{
    width: 50%;
    height: 90%;
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