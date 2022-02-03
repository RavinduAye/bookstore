<template>
    <div class="container">
        <div id="app2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="title" v-model="radiobuttonvalue">
                    <label class="form-check-label" for="flexRadioDefault1">Book title</label>
            </div>
            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="description" checked v-model="radiobuttonvalue">
                    <label class="form-check-label" for="flexRadioDefault2">Book description</label>
            </div>
            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="genre" checked v-model="radiobuttonvalue">
                    <label class="form-check-label" for="flexRadioDefault2">Genre</label>
            </div>

            <form class="d-flex">
                <input class="form-control me-2" type="text" v-model="search" placeholder="Search" aria-label="Search">
                <button @click.prevent="searchBooks()" class="btn btn-success">Search</button>
            </form>
        </div>

        <div id="app3" v-show="error" value="err">
            <p class="text-danger fs-4 text-center font-weight-bold">{{error}}</p>
        </div>

        <div v-if="showsearch==true">
            <div id="app5" v-for="searchbooks in searchbooks" :key="searchbooks.id" class="col-md-6">
                <div class="container">
                    <div class="row" >
                        <div class="col-md-2 offset-md-1 app6">Image</div>
                        <div class="col app8">
                            <div class="app10">
                                <p id="f1">{{searchbooks.Title}}</p>
                                <p id="f2">{{searchbooks.Genre}}</p>
                                <p id="f3">{{searchbooks.Description}}</p>
                                <span><b>Rs.</b>{{searchbooks.Price}}</span> 
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
                                <p id="f1">{{books.Title}}</p>
                                <p id="f2">{{books.Genre}}</p>
                                <p id="f3">{{books.Description}}</p>
                                <span><b>Rs.</b>{{books.Price}}</span>
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
            showsearch: false,
            radiobuttonvalue: '',
            error:''
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

            if ("title"==this.radiobuttonvalue) 
            {
                //console.log("title");
                this.$http.get("http://localhost:8000/api/searcht?q=" +this.search)
                .then(response => response.json())
                .then(response => {
                    this.searchbooks = response;
                    this.search='';
                    this.error='';
                    this.showsearch = true;
            })

                .catch(err => {
                    console.log(err);
                });

            }
                else if ("description"==this.radiobuttonvalue)
            {    
            this.$http.get("http://localhost:8000/api/searchd?q=" +this.search)
                .then(response => response.json())
                .then(response => {
                    this.searchbooks = response;
                    this.search='';
                    this.error='';
                    this.showsearch = true;
                })

                .catch(err => {
                    console.log(err);
                });
            }
                else if ("genre"==this.radiobuttonvalue)
            {    
                this.$http.get("http://localhost:8000/api/searchg?q=" +this.search)
                .then(response => response.json())
                .then(response => {
                    this.searchbooks = response;
                    this.search='';
                    this.error='';
                    this.showsearch = true;
                })
                .catch(err => {
                    console.log(err);
                });
            }
            else{
                this.error = "Please select a type";
            }
        }
    }
}
</script>

<style>

/* fonts design */

 span { font-size: 2.5em; font-weight:500;}
 span b { font-size: 60%; font-weight: normal; font-family: oblique;}
 #f1{
     font-size: 1.8pc;
     font-weight: bold;
     font-family: Lucida;
 }
 #f2{
     font-size: 1.6pc;
     font-family: Arial, sans-serif;
 }
 #f3{
     font-size: 1.5pc;
     font-family: Lucida;
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

#app3{
    height: 50px;
    margin-top:10px;
    background-color: #ffcccb;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

#app5{
    display: flex;
    margin-top:20px;
    background: #f8f9fa;
    width: 100%;
    height: 400px;
    border-radius: 8px;
    border: 2px solid black;
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