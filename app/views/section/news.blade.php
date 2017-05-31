@include('layouts.homeHead')
<div class="wrapper news">

<div class="preload">
  <img src="{{url()}}/public/img/news/background.jpg">
  <img src="{{url()}}/public/img/news/highlight.jpg">
  <img src="{{url()}}/public/img/news/mask.png">
</div>

@include('layouts.homeHeader')



<!-- ============================================================================================================================


** Highlight


============================================================================================================================== -->

<section class="highlight">


<div class="content">
  <h3>News & media</h3>
  <article class="news">
    <a href="#news">
      <div><i></i></div>
      <h4>News</h4>
    </a>
  </article>
  <article class="press">
  <a href="#press">
    <div><i></i></div>
    <h4>Press releases</h4>
  </a>
</article>
  <article class="campaigns last">
  <a href="#campaigns">
    <div><i></i></div>
    <h4>Campaigns</h4>
    </a>
  </article>

  <span>
   
  </span>

</div>


</section><!-- //Highlight -->


<section class="background">
  <div class="center">
 


<div class="slider_news">
<span class="next"></span>
<span class="prev"></span>

<div class="swiper-container" id="news">
  

  <div class="swiper-wrapper">
      
      <div class="swiper-slide"> 
   
      <img src="{{url()}}/public/upload/news_1.jpg">
      <div>
        <h3>News <i></i></h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
      </div>
      </div>
    
      <div class="swiper-slide">
      <img src="{{url()}}/public/upload/news_2.jpg">
            <div>
        <h3>News <i></i></h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
      </div>
      </div>
      
    
      <div class="swiper-slide"> 
      <img src="{{url()}}/public/upload/news_3.jpg">
            <div>
        <h3>News <i></i></h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
      </div>
    
      </div>
     
  </div>
</div>

</div>

<div class="slider_press">
<span class="next"></span>
<span class="prev"></span>

<div class="swiper-container" id="press">
  


  <div class="swiper-wrapper">
      
      <div class="swiper-slide"> 
   
      <img src="{{url()}}/public/upload/press_1.jpg">
      <div>
        <h3><i></i> Press Release</h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
      </div>
      </div>
    
      <div class="swiper-slide">
      <img src="{{url()}}/public/upload/news_2.jpg">
            <div>
        <h3><i></i> Press Release</h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
      </div>
      </div>
      
    
      <div class="swiper-slide"> 
      <img src="{{url()}}/public/upload/news_3.jpg">
            <div>
        <h3><i></i> Press Release</h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
      </div>
    
      </div>
     
  </div>
</div>
</div>


<div class="slider_campaigns">
<span class="next"></span>
<span class="prev"></span>

<div class="swiper-container" id="campaigns">
  
  <div class="swiper-wrapper">
      
      <div class="swiper-slide"> 
   
      <img src="{{url()}}/public/upload/campaigns_1.jpg">
      <div>
        <h3>Campaigns <i></i></h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
      </div>
      </div>
    
      <div class="swiper-slide">
      <img src="{{url()}}/public/upload/news_2.jpg">
            <div>
        <h3>Campaigns <i></i></h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
      </div>
      </div>
      
    
      <div class="swiper-slide"> 
      <img src="{{url()}}/public/upload/news_3.jpg">
            <div>
        <h3>Campaigns <i></i></h3>
        <small>Abril 29, 2014</small>
        <h4>Integer porta accumsan dolor, consectetur risus lacinia quis.</h4>
        <div class="scrollable">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget eros ultricies enim pellentesque facilisis non sit amet lectus. Vivamus ac lobortis urna. Duis lobortis, nunc at egestas pretium, metus tellus sollicitudin arcu...</p>
        </div>
        <a href="javascript:void(0)" class="facebook">
        <svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
        </a>
        <a href="javascript:void(0)" class="twitter">
        <svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"></path></svg>
        </a>
      </div>
    
      </div>
     
  </div>
</div>
</div>


  </div>
</section>


    @include('layouts.homeFooter')

    @include('layouts.homeMobile_menu')
    </div><!-- //wrapper -->

    @include('layouts.homeScripts')


    </body>
</html>
