
<template>
 <div>
  <input type="text" placeholder="Search events here ...." v-model="keyword" v-on:keyup="searchEvents" class="form-control">
  <div class="card-footer" v-if="results.length">
    <ul class="list-group">
        <li class="list-group-item" v-for="result in results">
            <a style="color:#000;" :href=" '/events/' + result.id +'/'+result.title+'/'  ">{{result.title}}
                <br>
                <small class="badge badge-success">{{result.location}}</small>
            </a>
            
        </li>
    </ul>
  </div>
  
 </div>
</template>


<script>
 export default{
  data(){
    return{
        keyword:'',
        results:[],
    }
  },
  methods: {
   searchEvents(){
    this.results = [];
    if(this.keyword.length>1){
        axios.get('/events/search',{params:{keyword:this.keyword}}).then(response=>{
            console.log(response.data) 
            this.results =  response.data;
        });
    }
    
  }
 }
}
</script>