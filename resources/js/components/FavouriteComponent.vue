<template>
    <div>
   
<button v-if="show" @click.prevent="removeEvent()" class="btn btn-danger btn-m" style="width: 100%;margin:5px">
    <i class="fas fa-ban"></i> Remove From Favourites</button>   
<button v-else @click.prevent="addEvent()" class="btn btn-dark btn-m" style="width: 100%;margin:5px" >
  <i class="far fa-star"></i> Add To Favourites</button>
      
    </div>
</template>

<script>

    export default {
        props:['eventid','fav'],
        
        data()
            {
            return{
                'show':true
            }
        },

        mounted()
        {
             console.log('Component mounted.')
            this.show = this.eventFav ? true:false;
        },
 
        computed:
        {
           eventFav()
           {
              return this.fav
           }
        },       
        methods:{
            
            addEvent(){
                axios.post('/add/'+this.eventid).then(response=>this.show=true).catch(error=>alert('error'));

            },

            removeEvent(){
                 axios.post('/remove/'+this.eventid).then(response=>this.show=false).catch(error=>alert('error'));

            }
            
        }
        

    }
</script>
