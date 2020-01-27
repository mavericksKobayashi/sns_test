<footer id=footer>
  <!--<div class="img_area pc">
    <a href="#" class="bottom_hover"><span>FLIP</span>の<span>使い方</span></a>
  </div>-->
  <div class="footer_cont">
    <h1 class="ttl lang_jp"><span>#</span>旅するSNS</h1>
    <p>
      {{ __('components.footer_p') }}
    </p>
    <div class="footer_menu">
      <div class="footer_logo">
        <img src="{{ asset('img/logo_gray.svg') }}" alt="FLIP">
      </div>
      <a href="https://mavericks09.com/" class="text_hover" target="_blank">
        {{ __('components.footer_company') }}
      </a>
      <a href="/privacy" class="text_hover">
        {{ __('components.footer_policy') }}
      </a>
      <!-- <a href="faq" classtext_hover>
        {{ __('components.footer_faq') }}
      </a> -->
      <a href="/user_message/1" class="text_hover">
        {{ __('components.footer_contact') }}
      </a>
    </div>
    <div class="copy">
      © <script type="text/javascript">document.write(new Date().getFullYear());</script> FLIP All right reserved.
    </div>
    <div class="attention">
      {{ __('components.footer_attention1') }}<br>
      {{ __('components.footer_attention2') }}
    </div>
  </div>
</footer>
