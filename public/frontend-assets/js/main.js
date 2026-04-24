const bodyData = document.body?.dataset ?? {};
const CONTACT_API_URL = bodyData.contactApiUrl || "/api/contact-messages";
const WHATSAPP_NUMBER = String(bodyData.whatsappNumber || "919646522110").replace(/\D+/g, "");
const RECAPTCHA_ENABLED = bodyData.recaptchaEnabled !== "false";

const $ = (selector, root = document) => root.querySelector(selector);
const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

const escapeHtml = (value = "") =>
  String(value)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");

const parseJsonScript = (id) => {
  const node = document.getElementById(id);
  if (!node) return null;

  try {
    return JSON.parse(node.textContent);
  } catch {
    return null;
  }
};

const normalizeWebsiteUrl = (value = "") => {
  const url = String(value).trim();
  if (!url) return "";
  if (/^(https?:)?\/\//.test(url)) return url;
  return url.startsWith("/") ? url : `/${url}`;
};

const isEmbeddablePortfolioUrl = (value = "") => {
  const normalized = normalizeWebsiteUrl(value);
  if (!normalized) return false;

  try {
    return new URL(normalized, window.location.origin).origin === window.location.origin;
  } catch {
    return false;
  }
};

const renderPortfolioText = (value = "") =>
  String(value)
    .trim()
    .split(/\r\n|\r|\n/)
    .map((line) => line.trim())
    .filter(Boolean)
    .map((line) => `<p class="text-slate-600 leading-7">${escapeHtml(line)}</p>`)
    .join("");

const setModalState = (shell, open) => {
  if (!shell) return;

  const panel = $(".modal-panel", shell);
  const overlay = $(".modal-overlay", shell);

  if (open) {
    shell.hidden = false;
    document.body.classList.add("overflow-hidden");
  }

  shell.classList.toggle("is-open", open);
  panel?.classList.toggle("is-open", open);
  overlay?.classList.toggle("is-open", open);

  if (open) return;

  window.setTimeout(() => {
    if (!shell.classList.contains("is-open")) {
      shell.hidden = true;
      document.body.classList.remove("overflow-hidden");
    }
  }, 300);
};

const initHeader = () => {
  const drawer = $("#mobile-drawer");
  const overlay = $("#mobile-overlay");
  if (!drawer || !overlay) return;

  const setDrawerState = (open) => {
    drawer.classList.toggle("is-open", open);
    overlay.classList.toggle("is-open", open);
    document.body.classList.toggle("overflow-hidden", open);
  };

  $("[data-mobile-open]")?.addEventListener("click", () => setDrawerState(true));
  $("[data-mobile-close]")?.addEventListener("click", () => setDrawerState(false));
  overlay.addEventListener("click", () => setDrawerState(false));

  $$("[data-mobile-accordion]").forEach((button) => {
    button.addEventListener("click", () => {
      const target = document.getElementById(button.getAttribute("data-mobile-accordion") || "");
      if (!target) return;

      const isOpen = button.getAttribute("aria-expanded") === "true";
      $$("[data-mobile-accordion]").forEach((item) => item.setAttribute("aria-expanded", "false"));
      $$("[data-mobile-accordion-panel]").forEach((panel) => panel.classList.add("hidden"));

      if (!isOpen) {
        button.setAttribute("aria-expanded", "true");
        target.classList.remove("hidden");
      }
    });
  });
};

const initChatbot = () => {
  const panel = $("#chatbot-panel");
  const toggle = $("#chatbot-toggle");
  const close = $("#chatbot-close");
  const send = $("#chatbot-send");
  const input = $("#chatbot-input");
  const whatsapp = $("#chatbot-whatsapp");
  if (!panel || !toggle || !whatsapp) return;

  const setChatState = (open) => {
    panel.classList.toggle("is-open", open);
    whatsapp.classList.toggle("hidden", open);
    toggle.setAttribute("aria-expanded", String(open));
  };

  toggle.addEventListener("click", () => setChatState(toggle.getAttribute("aria-expanded") !== "true"));
  close?.addEventListener("click", () => setChatState(false));
  send?.addEventListener("click", () => {
    const message = encodeURIComponent((input?.value || "Hello!").trim() || "Hello!");
    window.open(`https://wa.me/${WHATSAPP_NUMBER}?text=${message}`, "_blank", "noopener,noreferrer");
  });
};

const initFresherModal = () => {
  const shell = $("#fresher-modal-shell");
  if (!shell) return;

  $$("[data-open-fresher]").forEach((button) => {
    button.addEventListener("click", () => setModalState(shell, true));
  });
  $$("[data-close-fresher]").forEach((button) => {
    button.addEventListener("click", () => setModalState(shell, false));
  });
  $(".modal-overlay", shell)?.addEventListener("click", () => setModalState(shell, false));

  const fileInput = $("#fresher-file");
  const fileName = $("#fresher-file-name");
  fileInput?.addEventListener("change", () => {
    if (fileName) fileName.textContent = fileInput.files?.[0]?.name || "No file chosen";
  });
};

const getRecaptchaToken = (form) =>
  !RECAPTCHA_ENABLED ? "recaptcha-disabled" : form.querySelector('textarea[name="g-recaptcha-response"]')?.value || "";

const initRecaptchaFallback = () => {
  if (RECAPTCHA_ENABLED) return;

  $$(".g-recaptcha").forEach((node) => {
    if (node.childElementCount > 0 || node.textContent.trim()) return;
    node.innerHTML = '<span style="font-weight:700;color:#4b5563;letter-spacing:0.02em;">reCAPTCHA</span>';
  });
};

const initPhoneInputs = () => {
  $$('input[name="phone"]').forEach((input) => {
    const sanitize = () => {
      input.value = input.value.replace(/\D+/g, "");
    };

    input.setAttribute("inputmode", "numeric");
    input.setAttribute("autocomplete", "tel-national");
    input.setAttribute("pattern", "[0-9]*");
    input.addEventListener("input", sanitize);
    input.addEventListener("paste", () => window.setTimeout(sanitize, 0));
  });
};

const setButtonLoading = (form, loading, text) => {
  const button = $('button[type="submit"]', form);
  if (!button) return;

  button.dataset.originalText ||= button.textContent.trim();
  button.disabled = loading;
  button.textContent = loading ? text : button.dataset.originalText;
};

const serializeContactForm = (form) => {
  const data = new FormData();
  const phone = form.elements.phone?.value || "";

  ["name", "email", "subject", "message", "country_code"].forEach((field) => {
    data.append(field, form.elements[field]?.value || "");
  });
  if (phone) data.append("phone", phone);
  data.append("recaptcha", getRecaptchaToken(form));

  return data;
};

const initForms = () => {
  $$("form").forEach((form) => {
    form.addEventListener("submit", async (event) => {
      const route = document.body?.dataset.route || "";
      const isFresher = Boolean(form.closest("#fresher-modal-shell"));
      const isInternship = !isFresher && route === "/internship";
      const isContact =
        !isFresher &&
        !isInternship &&
        ["name", "email", "subject", "message"].every((field) => form.elements[field]);

      if (!isFresher && !isInternship && !isContact) return;
      event.preventDefault();

      if (isFresher) {
        setButtonLoading(form, true, "Processing...");
        window.setTimeout(() => {
          alert("Application sent successfully!");
          form.reset();
          const nameNode = $("#fresher-file-name");
          if (nameNode) nameNode.textContent = "No file chosen";
          setButtonLoading(form, false, "Processing...");
          setModalState($("#fresher-modal-shell"), false);
        }, 1200);
        return;
      }

      if (!getRecaptchaToken(form)) {
        alert(isInternship ? "Please complete the ReCAPTCHA" : "Please verify the captcha");
        return;
      }

      if (isInternship) {
        setButtonLoading(form, true, "Sending...");
        window.setTimeout(() => {
          alert("Internship request submitted successfully!");
          form.reset();
          setButtonLoading(form, false, "Sending...");
        }, 1200);
        return;
      }

      setButtonLoading(form, true, "sending...");

      try {
        const response = await fetch(CONTACT_API_URL, {
          method: "POST",
          headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
          },
          body: serializeContactForm(form),
        });
        const raw = await response.text();
        let result = {};

        try {
          result = raw ? JSON.parse(raw) : {};
        } catch {
          throw new Error("The contact form returned an invalid response. Please try again.");
        }

        if (!response.ok) {
          const firstError = result.errors ? Object.values(result.errors).flat()[0] : null;
          throw new Error(firstError || result.message || "Unable to send message");
        }

        alert(result.message || "message sent!");
        form.reset();

        try {
          window.grecaptcha?.reset();
        } catch {
          // Ignore routes without an active widget.
        }
      } catch (error) {
        alert(error.message || "error sending message");
      } finally {
        setButtonLoading(form, false, "sending...");
      }
    });
  });
};

const initVideoCards = () => {
  $$("[data-video-url]").forEach((card) => {
    card.addEventListener("click", () => {
      const url = card.getAttribute("data-video-url");
      if (!url || card.dataset.loaded === "true") return;

      card.dataset.loaded = "true";
      card.innerHTML = `
        <iframe
          src="${escapeHtml(`${url}?autoplay=1&rel=0&modestbranding=1`)}"
          title="Sortiq video"
          class="w-full h-full border-0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
          loading="lazy"
        ></iframe>
      `;
    });
  });
};

const initHeroSlider = () => {
  const data = parseJsonScript("hero-slides-data");
  if (!data?.slides?.length) return;

  const title = $("#hero-slide-title");
  const desc = $("#hero-slide-desc");
  const player = $("#hero-slide-player");
  let index = 0;

  const render = () => {
    const slide = data.slides[index];
    if (!slide) return;
    if (title) title.textContent = slide.title;
    if (desc) desc.textContent = slide.desc;
    if (player) player.setAttribute("src", slide.animation);
  };

  $("#hero-prev")?.addEventListener("click", () => {
    index = (index - 1 + data.slides.length) % data.slides.length;
    render();
  });
  $("#hero-next")?.addEventListener("click", () => {
    index = (index + 1) % data.slides.length;
    render();
  });

  render();
  window.setInterval(() => {
    index = (index + 1) % data.slides.length;
    render();
  }, 6000);
};

const initCertificationsSlider = () => {
  const slider = $("[data-certifications-slider]");
  const track = slider && $("[data-certifications-track]", slider);
  if (!slider || !track || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const cards = Array.from(track.children).filter((node) => node instanceof HTMLElement);
  if (cards.length < 2 || cards.length % 2 !== 0) return;

  let offset = 0;
  let resetPoint = 0;
  let lastTime = 0;
  let paused = false;
  let inView = true;

  const speed = () => (window.innerWidth >= 1024 ? 72 : window.innerWidth >= 640 ? 58 : 44);
  const paint = () => {
    track.style.transform = `translate3d(-${offset}px,0,0)`;
  };
  const measure = () => {
    const midpoint = cards[Math.floor(cards.length / 2)];
    resetPoint = midpoint ? midpoint.offsetLeft - cards[0].offsetLeft : 0;
    if (resetPoint <= 0) return (track.style.transform = "");
    offset %= resetPoint;
    paint();
  };
  const resetClock = () => {
    lastTime = 0;
  };
  const tick = (time) => {
    if (!lastTime) lastTime = time;
    const delta = (time - lastTime) / 1000;
    lastTime = time;

    if (!paused && inView && document.visibilityState === "visible" && resetPoint > 0) {
      offset += speed() * delta;
      if (offset >= resetPoint) offset -= resetPoint;
      paint();
    }

    window.requestAnimationFrame(tick);
  };

  ["mouseenter", "focusin"].forEach((event) => slider.addEventListener(event, () => (paused = true)));
  ["mouseleave", "focusout"].forEach((event) =>
    slider.addEventListener(event, () => {
      paused = false;
      resetClock();
    })
  );

  document.addEventListener("visibilitychange", resetClock);
  window.addEventListener("resize", measure, { passive: true });
  window.addEventListener("load", measure, { once: true });
  if ("ResizeObserver" in window) new ResizeObserver(measure).observe(slider);
  if ("IntersectionObserver" in window) {
    new IntersectionObserver(
      ([entry]) => {
        inView = entry?.isIntersecting ?? true;
        if (inView) resetClock();
      },
      { threshold: 0.15 }
    ).observe(slider);
  }

  measure();
  window.requestAnimationFrame(tick);
};

const initStatsCounters = () => {
  const counters = $$("[data-count-end]");
  if (!counters.length) return;

  const revealCounter = (node) => {
    const end = Number(node.getAttribute("data-count-end") || "0");
    const start = performance.now();

    const step = (time) => {
      const progress = Math.min((time - start) / 2000, 1);
      node.textContent = `${Math.floor(progress * end)}+`;
      if (progress < 1) return window.requestAnimationFrame(step);
      node.textContent = `${end}+`;
    };

    window.requestAnimationFrame(step);
  };

  if (!("IntersectionObserver" in window)) {
    counters.forEach(revealCounter);
    return;
  }

  counters.forEach((node) => {
    const observer = new IntersectionObserver(([entry]) => {
      if (!entry?.isIntersecting) return;
      observer.disconnect();
      revealCounter(node);
    }, { threshold: 0.4 });

    observer.observe(node);
  });
};

const initTestimonials = () => {
  $$("[data-testimonials-section]").forEach((section) => {
    const panels = $$("[data-testimonial-panel]", section);
    const triggers = $$("[data-testimonial-trigger]", section);
    if (!panels.length || !triggers.length) return;

    let active = 0;
    const render = () => {
      panels.forEach((panel, index) => {
        panel.hidden = index !== active;
      });

      triggers.forEach((trigger, index) => {
        const isActive = index === active;
        trigger.setAttribute("aria-pressed", String(isActive));
        trigger.classList.toggle("opacity-40", !isActive);
        $("[data-testimonial-avatar]", trigger)?.classList.toggle("bg-[#002d5b]", isActive);
        $("[data-testimonial-avatar]", trigger)?.classList.toggle("ring-[6px]", isActive);
        $("[data-testimonial-avatar]", trigger)?.classList.toggle("ring-[#ff6a00]", isActive);
        $("[data-testimonial-avatar]", trigger)?.classList.toggle("bg-slate-300", !isActive);
        $("[data-testimonial-initials]", trigger)?.classList.toggle("text-white", isActive);
        $("[data-testimonial-initials]", trigger)?.classList.toggle("text-xl", isActive);
        $("[data-testimonial-initials]", trigger)?.classList.toggle("md:text-2xl", isActive);
        $("[data-testimonial-initials]", trigger)?.classList.toggle("text-gray-100", !isActive);
        $("[data-testimonial-initials]", trigger)?.classList.toggle("text-base", !isActive);
        $("[data-testimonial-initials]", trigger)?.classList.toggle("md:text-lg", !isActive);
        $("[data-testimonial-name]", trigger)?.classList.toggle("text-[#002d5b]", isActive);
        $("[data-testimonial-name]", trigger)?.classList.toggle("text-[#94a3b8]", !isActive);
        $("[data-testimonial-badge]", trigger)?.classList.toggle("hidden", !isActive);
        $("[data-testimonial-verified]", trigger)?.classList.toggle("hidden", !isActive);
      });
    };

    triggers.forEach((button) => {
      button.addEventListener("click", () => {
        active = Number(button.getAttribute("data-testimonial-index") || "0");
        render();
      });
    });

    render();
    window.setInterval(() => {
      active = (active + 1) % panels.length;
      render();
    }, 7000);
  });
};

const initPortfoliosPage = () => {
  const modal = $("#portfolio-modal");
  const contentNode = $("#portfolio-modal-content");
  if (!modal || !contentNode) return;

  $$("[data-portfolio-item]").forEach((button) => {
    button.addEventListener("click", () => {
      const projectUrl = normalizeWebsiteUrl(button.getAttribute("data-portfolio-url"));
      const title = button.getAttribute("data-portfolio-title")?.trim() || "Portfolio Project";
      const category = button.getAttribute("data-portfolio-category")?.trim() || "Portfolio";
      const imageUrl = button.getAttribute("data-portfolio-image")?.trim() || "";
      const summary = button.getAttribute("data-portfolio-summary")?.trim() || "";
      const content = button.getAttribute("data-portfolio-content")?.trim() || "";
      const canEmbed = isEmbeddablePortfolioUrl(projectUrl);

      modal.hidden = false;
      contentNode.innerHTML = `
        <div class="grid lg:grid-cols-[minmax(0,1.05fr)_minmax(320px,0.95fr)]">
          <div class="bg-slate-950">
            ${
              imageUrl
                ? `<img src="${escapeHtml(imageUrl)}" class="w-full h-full object-cover min-h-[280px]" alt="${escapeHtml(title)}">`
                : `<div class="flex min-h-[280px] items-center justify-center px-8 text-center text-2xl font-black text-white">${escapeHtml(title)}</div>`
            }
          </div>
          <div class="p-6 md:p-8">
            <div class="inline-flex items-center rounded-full bg-orange-50 px-3 py-1 text-xs font-black uppercase tracking-[0.18em] text-[#ff6600]">${escapeHtml(category)}</div>
            <h2 class="mt-4 text-2xl md:text-3xl font-black text-[#001a3d]">${escapeHtml(title)}</h2>
            ${summary ? `<p class="mt-4 text-[15px] leading-7 text-slate-700">${escapeHtml(summary)}</p>` : ""}
            ${content ? `<div class="mt-6 space-y-4">${renderPortfolioText(content)}</div>` : ""}
            ${
              projectUrl
                ? `<div class="mt-8 flex flex-wrap gap-3">
                    <a href="${escapeHtml(projectUrl)}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full bg-[#001a3d] px-5 py-3 text-sm font-black uppercase tracking-[0.12em] text-white transition-colors hover:bg-[#ff6600]">
                      Open Project
                      <span aria-hidden="true">&rarr;</span>
                    </a>
                  </div>`
                : ""
            }
          </div>
        </div>
        ${
          canEmbed
            ? `<div class="border-t border-slate-200 bg-slate-50 p-4 md:p-6">
                 <div class="mb-3">
                   <h3 class="text-lg font-black text-[#001a3d]">Live Preview</h3>
                   <p class="text-sm text-slate-500">If the preview does not load, open the project in a new tab.</p>
                 </div>
                 <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                   <iframe src="${escapeHtml(projectUrl)}" title="${escapeHtml(title)}" class="h-[70vh] w-full bg-white" loading="lazy"></iframe>
                 </div>
               </div>`
            : ""
        }
      `;
    });
  });

  $("#portfolio-modal-close")?.addEventListener("click", () => {
    modal.hidden = true;
  });
  modal.addEventListener("click", (event) => {
    if (event.target === modal) modal.hidden = true;
  });
};

const initFaqPage = () => {
  const buttons = $$("[data-faq-button]");
  if (!buttons.length) return;

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const panel = document.getElementById(button.getAttribute("data-faq-button") || "");
      if (!panel) return;

      const expanded = button.getAttribute("aria-expanded") === "true";
      buttons.forEach((item) => item.setAttribute("aria-expanded", "false"));
      $$(".faq-panel").forEach((item) => {
        item.hidden = true;
      });
      $$("[data-faq-button] iconify-icon").forEach((icon) => {
        icon.classList.remove("rotate-180", "text-[#ff6600]");
        icon.classList.add("text-gray-400");
      });

      if (!expanded) {
        button.setAttribute("aria-expanded", "true");
        panel.hidden = false;
        $("iconify-icon", button)?.classList.add("rotate-180", "text-[#ff6600]");
        $("iconify-icon", button)?.classList.remove("text-gray-400");
      }
    });
  });
};

document.addEventListener("DOMContentLoaded", () => {
  initHeader();
  initChatbot();
  initFresherModal();
  initRecaptchaFallback();
  initPhoneInputs();
  initForms();
  initVideoCards();
  initHeroSlider();
  initCertificationsSlider();
  initStatsCounters();
  initTestimonials();
  initPortfoliosPage();
  initFaqPage();
});
