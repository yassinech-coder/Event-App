<div style="height: 113px;"></div>

<div class="site-blocks-cover overlay" style="background-image: url('external/images/cc.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12" data-aos="fade">
        <h1>Find Event</h1>
        <form action="{{route('allevents')}}">
          <div class="row mb-3">
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                  <input type="text" name="title" class="mr-3 form-control border-0 px-4"  placeholder="event title or keywords ">
                </div>
                <div class="col-md-6 mb-3 mb-md-0">
                  <div class="input-wrap">
                    <span class="icon icon-room"></span>
                  <input type="text" name="location" class="form-control form-control-block search-input  border-0 px-4" placeholder="city, province or region">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <input type="submit" class="btn btn-search btn-danger btn-block" value="Search">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="small">or browse by category: <a href="#search_category" class="category">Category</a>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>

