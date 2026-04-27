@extends('layouts.frontend')

@section('title', 'contact us | sortiq solutions')
@section('body_attributes') data-route="/contact" @endsection

@section('content')
<main class="font-raleway">
  <div class="contact-page">
    <div class="inner-content">
      <div class="top-title">
        <h2>Get in Touch with us!</h2>
        <p>We're here to assist</p>
        <div class="line-dec"></div>
      </div>

      <div class="contact-layout">
        <div class="contact-form-column">
          
  <form class="space-y-4 font-raleway">
    <input type="hidden" name="country_code" value="+91">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="relative">
        <iconify-icon icon="lucide:user" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
        <input name="name" type="text" placeholder="enter your name" class="w-full pl-11 py-3 border rounded-md bg-gray-50/30 outline-none focus:border-[#ff5a00]" required>
      </div>
      <div class="relative">
        <iconify-icon icon="lucide:mail" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
        <input name="email" type="email" placeholder="enter your email" class="w-full pl-11 py-3 border rounded-md bg-gray-50/30 outline-none focus:border-[#ff5a00]" required>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <label class="contact-phone-field" for="contact-phone">
        <div class="contact-phone-prefix" aria-hidden="true">
          <img src="{{ asset('frontend-assets/media/flags/india.webp') }}" alt="India flag" class="contact-phone-flag" loading="lazy" decoding="async">
          <span class="contact-phone-code">+91</span>
        </div>
        <input id="contact-phone" name="phone" type="tel" inputmode="numeric" placeholder="Phone number" class="contact-phone-input" autocomplete="tel-national" required>
      </label>

      <div class="relative">
        <iconify-icon icon="lucide:list-checks" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
        <input name="subject" type="text" placeholder="subject" class="w-full pl-11 py-3 border rounded-md bg-gray-50/30 outline-none focus:border-[#ff5a00]" required>
      </div>
    </div>

    <div class="relative">
      <iconify-icon icon="lucide:message-square" width="20" height="20" class="absolute left-3 top-3 text-[#ff5a00]"></iconify-icon>
      <textarea name="message" rows="5" placeholder="enter your message" class="w-full pl-11 py-3 border rounded-md bg-gray-50/30 resize-none outline-none focus:border-[#ff5a00]" required></textarea>
    </div>

    <div class="py-2">
      @include('components.recaptcha')
    </div>

    <button type="submit" class="w-full bg-[#ff5a00] text-white font-bold py-4 rounded-md hover:bg-[#e65100] transition-colors uppercase">
      send message
    </button>
  </form>

        </div>

        <aside class="sidebar">
          <div class="item-b">
            <div class="ico-box">
              <iconify-icon icon="ant-design:phone-filled" width="22" height="22" class="flip-ico"></iconify-icon>
            </div>
            <div>
              <h4>call us</h4>
              <p>+91 9646522110</p>
            </div>
          </div>

          <div class="item-b">
            <div class="ico-box">
              <iconify-icon icon="ant-design:mail-filled" width="22" height="22"></iconify-icon>
            </div>
            <div>
              <h4>write us</h4>
              <p>info@sortiqsolutions.com<br>sortiqsolutions@gmail.com</p>
            </div>
          </div>

          <div class="item-b">
            <div class="ico-box">
              <iconify-icon icon="ant-design:environment-filled" width="22" height="22"></iconify-icon>
            </div>
            <div>
              <h4>visit us</h4>
              <p>e-51, phase - 8, mohali, punjab 160071</p>
            </div>
          </div>

          <div class="social-box">
            <a href="https://www.facebook.com/SortiqSolutions/" class="s-link" aria-label="Facebook"><iconify-icon icon="fa6-brands:facebook-f" width="16" height="16"></iconify-icon></a>
            <a href="https://www.linkedin.com/company/sortiq-solutions/" class="s-link" aria-label="LinkedIn"><iconify-icon icon="fa6-brands:linkedin-in" width="16" height="16"></iconify-icon></a>
            <a href="https://www.instagram.com/sortiqsolutions/" class="s-link" aria-label="Instagram"><iconify-icon icon="fa6-brands:instagram" width="16" height="16"></iconify-icon></a>
            <a href="https://www.youtube.com/@SortiqSolutions" class="s-link" aria-label="YouTube"><iconify-icon icon="fa6-brands:youtube" width="16" height="16"></iconify-icon></a>
            <a href="https://x.com/SortiqSolutions" class="s-link" aria-label="Twitter"><iconify-icon icon="fa6-brands:x-twitter" width="16" height="16"></iconify-icon></a>
            <a href="https://medium.com/@sortiqsolutions" class="s-link" aria-label="Medium"><iconify-icon icon="fa6-brands:medium" width="16" height="16"></iconify-icon></a>
            <a href="https://in.pinterest.com/sortiqsolutions/" class="s-link" aria-label="Pinterest"><iconify-icon icon="fa6-brands:pinterest-p" width="16" height="16"></iconify-icon></a>
          </div>
        </aside>
      </div>
    </div>

    <style>
      .contact-page {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 80px 0;
      }

      .contact-page * {
        font-family: 'Raleway', sans-serif !important;
      }

      .contact-page .inner-content {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
      }

      .contact-page .top-title {
        text-align: center;
        margin-bottom: 50px;
      }

      .contact-page .top-title h2 {
        color: #001a3d;
        font-size: 34px;
        font-weight: 800;
      }

      .contact-page .top-title p {
        color: #001a3d;
        font-size: 18px;
        font-weight: 700;
      }

      .contact-page .line-dec {
        width: 45px;
        height: 4px;
        background: #ff6600;
        margin: 15px auto 0;
      }

      .contact-page .contact-layout {
        display: grid;
        gap: 50px 30px;
        align-items: start;
      }

      .contact-page .contact-form-column {
        min-width: 0;
      }

      .contact-page .sidebar {
        display: flex;
        flex-direction: column;
        gap: 40px;
      }

      .contact-page .contact-phone-field {
        display: flex;
        align-items: center;
        min-height: 52px;
        border: 1px solid #d7dde5;
        border-radius: 8px;
        background: #fff;
        overflow: hidden;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        cursor: text;
      }

      .contact-page .contact-phone-field:focus-within {
        border-color: #ff5a00;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(255, 90, 0, 0.08);
      }

      .contact-page .contact-phone-prefix {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        justify-content: center;
        min-width: 92px;
        padding: 0 14px;
        border-right: 1px solid #d7dde5;
        background: #f8fafc;
        height: 100%;
        font-size: 15px;
        font-weight: 700;
        color: #001a3d;
        white-space: nowrap;
        flex-shrink: 0;
      }

      .contact-page .contact-phone-flag {
        width: 18px;
        height: auto;
        border-radius: 2px;
        flex-shrink: 0;
      }

      .contact-page .contact-phone-code {
        line-height: 1;
      }

      .contact-page .contact-phone-input {
        width: 100%;
        min-width: 0;
        border: 0;
        background: transparent;
        height: 100%;
        padding: 0 16px;
        outline: none;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.2;
        color: #001a3d;
      }

      .contact-page .contact-phone-input::placeholder {
        color: #6b7280;
      }

      .contact-page .contact-phone-input::-webkit-outer-spin-button,
      .contact-page .contact-phone-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      .contact-page .contact-phone-input[type="tel"] {
        appearance: none;
      }

      .contact-page .item-b {
        display: flex;
        align-items: center;
        gap: 20px;
      }

      .contact-page .ico-box {
        background: #ff6600;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        flex-shrink: 0;
      }

      .contact-page .flip-ico {
        transform: scaleX(-1);
      }

      .contact-page .item-b h4 {
        font-weight: 700;
        color: #001a3d;
        text-transform: uppercase;
        margin: 0 0 4px;
        font-size: 14px;
        letter-spacing: 1px;
      }

      .contact-page .item-b p {
        font-weight: 600;
        color: #001a3d;
        font-size: 17px;
        margin: 0;
        line-height: 1.55;
      }

      .contact-page .social-box {
        display: flex;
        gap: 12px;
        padding-top: 30px;
        border-top: 1px solid #ddd;
        margin-top: 10px;
        flex-wrap: wrap;
      }

      .contact-page .s-link {
        background: #ff6600;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        transition: 0.3s;
      }

      .contact-page .s-link:hover {
        background: #001a3d;
        transform: translateY(-3px);
      }

      @media (min-width: 1024px) {
        .contact-page .contact-layout {
          grid-template-columns: minmax(0, 1fr) 320px;
        }

        .contact-page .sidebar {
          padding-left: 20px;
        }
      }

      @media (max-width: 767px) {
        .contact-page {
          padding: 56px 0;
        }

        .contact-page .top-title {
          margin-bottom: 40px;
        }

        .contact-page .top-title h2 {
          font-size: 30px;
        }

        .contact-page .item-b p {
          font-size: 15px;
        }
      }
    </style>
  </div>
</main>
@endsection


