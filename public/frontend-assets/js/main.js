const runtimeDataset = document.body?.dataset ?? {};
const CONTACT_API_URL = runtimeDataset.contactApiUrl || "/api/contact-messages";
const WHATSAPP_NUMBER = String(runtimeDataset.whatsappNumber || "919646522110").replace(/\D+/g, "");
const RECAPTCHA_ENABLED = runtimeDataset.recaptchaEnabled !== "false";

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
  } catch (error) {
    return null;
  }
};

const runWhenIdle = (callback) => {
  if ("requestIdleCallback" in window) {
    window.requestIdleCallback(callback, { timeout: 1500 });
    return;
  }

  window.setTimeout(callback, 250);
};

const normalizeWebsiteUrl = (value = "") => {
  const url = String(value || "").trim();

  if (!url) return "";
  if (url.startsWith("http://") || url.startsWith("https://") || url.startsWith("//")) return url;

  return url.startsWith("/") ? url : `/${url}`;
};

const isEmbeddablePortfolioUrl = (value = "") => {
  const normalized = normalizeWebsiteUrl(value);

  if (!normalized) return false;

  try {
    const target = new URL(normalized, window.location.origin);

    return target.origin === window.location.origin;
  } catch (error) {
    return false;
  }
};

const renderPortfolioText = (value = "") => {
  const text = String(value || "").trim();

  if (!text) return "";

  return text
    .split(/\r\n|\r|\n/)
    .map((line) => line.trim())
    .filter(Boolean)
    .map((line) => `<p class="text-slate-600 leading-7">${escapeHtml(line)}</p>`)
    .join("");
};

const openModal = (shell) => {
  if (!shell) return;
  shell.hidden = false;
  shell.classList.add("is-open");
  document.body.classList.add("overflow-hidden");
  const panel = $(".modal-panel", shell);
  if (panel) panel.classList.add("is-open");
  const overlay = $(".modal-overlay", shell);
  if (overlay) overlay.classList.add("is-open");
};

const closeModal = (shell) => {
  if (!shell) return;
  shell.classList.remove("is-open");
  const panel = $(".modal-panel", shell);
  if (panel) panel.classList.remove("is-open");
  const overlay = $(".modal-overlay", shell);
  if (overlay) overlay.classList.remove("is-open");

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
  const openButton = $("[data-mobile-open]");
  const closeButton = $("[data-mobile-close]");

  const openDrawer = () => {
    if (!drawer || !overlay) return;
    drawer.classList.add("is-open");
    overlay.classList.add("is-open");
    document.body.classList.add("overflow-hidden");
  };

  const closeDrawer = () => {
    if (!drawer || !overlay) return;
    drawer.classList.remove("is-open");
    overlay.classList.remove("is-open");
    document.body.classList.remove("overflow-hidden");
  };

  openButton?.addEventListener("click", openDrawer);
  closeButton?.addEventListener("click", closeDrawer);
  overlay?.addEventListener("click", closeDrawer);

  $$("[data-mobile-accordion]").forEach((button) => {
    button.addEventListener("click", () => {
      const target = button.getAttribute("data-mobile-accordion");
      const panel = document.getElementById(target);
      if (!panel) return;

      const isOpen = button.getAttribute("aria-expanded") === "true";
      $$("[data-mobile-accordion]").forEach((item) => item.setAttribute("aria-expanded", "false"));
      $$("[data-mobile-accordion-panel]").forEach((item) => item.classList.add("hidden"));

      if (!isOpen) {
        button.setAttribute("aria-expanded", "true");
        panel.classList.remove("hidden");
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

  const syncState = (open) => {
    if (!panel || !toggle || !whatsapp) return;
    panel.classList.toggle("is-open", open);
    whatsapp.classList.toggle("hidden", open);
    toggle.setAttribute("aria-expanded", String(open));
  };

  toggle?.addEventListener("click", () => {
    const isOpen = toggle.getAttribute("aria-expanded") === "true";
    syncState(!isOpen);
  });

  close?.addEventListener("click", () => syncState(false));

  send?.addEventListener("click", () => {
    const message = encodeURIComponent((input?.value || "Hello!").trim() || "Hello!");
    window.open(`https://wa.me/${WHATSAPP_NUMBER}?text=${message}`, "_blank", "noopener,noreferrer");
  });
};

const initFresherModal = () => {
  const shell = $("#fresher-modal-shell");
  if (!shell) return;

  $$("[data-open-fresher]").forEach((button) => {
    button.addEventListener("click", () => openModal(shell));
  });

  $$("[data-close-fresher]").forEach((button) => {
    button.addEventListener("click", () => closeModal(shell));
  });

  $(".modal-overlay", shell)?.addEventListener("click", () => closeModal(shell));

  const fileInput = $("#fresher-file");
  const fileName = $("#fresher-file-name");
  fileInput?.addEventListener("change", () => {
    fileName.textContent = fileInput.files?.[0]?.name || "No file chosen";
  });
};

const initVideoCards = () => {
  $$("[data-video-url]").forEach((card) => {
    card.addEventListener("click", () => {
      if (card.dataset.loaded === "true") return;
      card.dataset.loaded = "true";
      const url = card.getAttribute("data-video-url");
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
  if (!data || !Array.isArray(data.slides) || data.slides.length === 0) return;

  const titleNode = $("#hero-slide-title");
  const descNode = $("#hero-slide-desc");
  const player = $("#hero-slide-player");
  const prev = $("#hero-prev");
  const next = $("#hero-next");
  let index = 0;

  const render = () => {
    const slide = data.slides[index];
    if (!slide) return;
    if (titleNode) titleNode.textContent = slide.title;
    if (descNode) descNode.textContent = slide.desc;
    if (player) player.setAttribute("src", slide.animation);
  };

  const advance = (direction = 1) => {
    index = (index + direction + data.slides.length) % data.slides.length;
    render();
  };

  prev?.addEventListener("click", () => advance(-1));
  next?.addEventListener("click", () => advance(1));

  render();
  window.setInterval(() => advance(1), 6000);
};

const initCertificationsSlider = () => {
  const slider = $("[data-certifications-slider]");
  const track = slider ? $("[data-certifications-track]", slider) : null;
  if (!slider || !track || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const cards = Array.from(track.children).filter((node) => node instanceof HTMLElement);
  if (cards.length < 2 || cards.length % 2 !== 0) return;

  let offset = 0;
  let resetPoint = 0;
  let lastTimestamp = 0;
  let isHovered = false;
  let isInView = true;

  const getSpeed = () => {
    if (window.innerWidth >= 1024) return 72;
    if (window.innerWidth >= 640) return 58;
    return 44;
  };

  const updateTransform = () => {
    track.style.transform = `translate3d(-${offset}px, 0, 0)`;
  };

  const measure = () => {
    const midpoint = cards[Math.floor(cards.length / 2)];
    const firstCard = cards[0];
    if (!midpoint || !firstCard) return;

    resetPoint = midpoint.offsetLeft - firstCard.offsetLeft;
    if (resetPoint <= 0) {
      track.style.transform = "";
      return;
    }

    offset %= resetPoint;
    updateTransform();
  };

  const resetClock = () => {
    lastTimestamp = 0;
  };

  const setHoverState = (value) => {
    isHovered = value;
    if (!value) resetClock();
  };

  const tick = (timestamp) => {
    if (!lastTimestamp) lastTimestamp = timestamp;
    const deltaSeconds = (timestamp - lastTimestamp) / 1000;
    lastTimestamp = timestamp;

    if (!isHovered && isInView && document.visibilityState === "visible" && resetPoint > 0) {
      offset += getSpeed() * deltaSeconds;
      if (offset >= resetPoint) offset -= resetPoint;
      updateTransform();
    }

    window.requestAnimationFrame(tick);
  };

  slider.addEventListener("mouseenter", () => setHoverState(true));
  slider.addEventListener("mouseleave", () => setHoverState(false));
  slider.addEventListener("focusin", () => setHoverState(true));
  slider.addEventListener("focusout", () => setHoverState(false));

  document.addEventListener("visibilitychange", resetClock);
  window.addEventListener("resize", measure, { passive: true });
  window.addEventListener("load", measure, { once: true });

  if ("ResizeObserver" in window) {
    const resizeObserver = new ResizeObserver(measure);
    resizeObserver.observe(slider);
  }

  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver((entries) => {
      isInView = entries[0]?.isIntersecting ?? true;
      if (isInView) resetClock();
    }, { threshold: 0.15 });
    observer.observe(slider);
  }

  measure();
  window.requestAnimationFrame(tick);
};

const initStatsCounters = () => {
  $$("[data-count-end]").forEach((node) => {
    const end = Number(node.getAttribute("data-count-end") || "0");
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        observer.disconnect();
        const duration = 2000;
        const start = performance.now();
        const animate = (timestamp) => {
          const progress = Math.min((timestamp - start) / duration, 1);
          node.textContent = `${Math.floor(progress * end)}+`;
          if (progress < 1) {
            requestAnimationFrame(animate);
          } else {
            node.textContent = `${end}+`;
          }
        };
        requestAnimationFrame(animate);
      });
    }, { threshold: 0.4 });
    observer.observe(node);
  });
};

const initTestimonials = () => {
  const sections = $$("[data-testimonials-section]");
  if (!sections.length) return;

  sections.forEach((section) => {
    const panels = $$("[data-testimonial-panel]", section);
    const triggers = $$("[data-testimonial-trigger]", section);
    if (!panels.length || !triggers.length) return;

    let activeIndex = 0;

    const render = () => {
      panels.forEach((panel, index) => {
        panel.hidden = index !== activeIndex;
      });

      triggers.forEach((trigger, index) => {
        const active = index === activeIndex;
        trigger.setAttribute("aria-pressed", String(active));
        trigger.classList.toggle("opacity-40", !active);

        const avatar = $("[data-testimonial-avatar]", trigger);
        const initials = $("[data-testimonial-initials]", trigger);
        const name = $("[data-testimonial-name]", trigger);
        const badge = $("[data-testimonial-badge]", trigger);
        const verified = $("[data-testimonial-verified]", trigger);

        if (avatar) {
          avatar.classList.toggle("bg-[#002d5b]", active);
          avatar.classList.toggle("ring-[6px]", active);
          avatar.classList.toggle("ring-[#ff6a00]", active);
          avatar.classList.toggle("bg-slate-300", !active);
        }

        if (initials) {
          initials.classList.toggle("text-white", active);
          initials.classList.toggle("text-xl", active);
          initials.classList.toggle("md:text-2xl", active);
          initials.classList.toggle("text-gray-100", !active);
          initials.classList.toggle("text-base", !active);
          initials.classList.toggle("md:text-lg", !active);
        }

        if (name) {
          name.classList.toggle("text-[#002d5b]", active);
          name.classList.toggle("text-[#94a3b8]", !active);
        }

        badge?.classList.toggle("hidden", !active);
        verified?.classList.toggle("hidden", !active);
      });
    };

    triggers.forEach((button) => {
      button.addEventListener("click", () => {
        activeIndex = Number(button.getAttribute("data-testimonial-index") || "0");
        render();
      });
    });

    render();
    window.setInterval(() => {
      activeIndex = (activeIndex + 1) % panels.length;
      render();
    }, 7000);
  });
};
const initPortfoliosPage = () => {
  const modal = $("#portfolio-modal");
  const modalContent = $("#portfolio-modal-content");
  const closeButton = $("#portfolio-modal-close");
  if (!modal || !modalContent) return;

  $$("[data-portfolio-item]").forEach((button) => {
    button.addEventListener("click", () => {
      const projectUrl = normalizeWebsiteUrl(button.getAttribute("data-portfolio-url") || "");
      const canEmbedProject = isEmbeddablePortfolioUrl(projectUrl);
      const summary = String(button.getAttribute("data-portfolio-summary") || "").trim();
      const content = String(button.getAttribute("data-portfolio-content") || "").trim();
      const imageUrl = String(button.getAttribute("data-portfolio-image") || "").trim();
      const title = String(button.getAttribute("data-portfolio-title") || "").trim() || "Portfolio Project";
      const category = String(button.getAttribute("data-portfolio-category") || "").trim() || "Portfolio";

      modal.hidden = false;
      modalContent.innerHTML = `
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
            ${
              summary
                ? `<p class="mt-4 text-[15px] leading-7 text-slate-700">${escapeHtml(summary)}</p>`
                : ""
            }
            ${
              content
                ? `<div class="mt-6 space-y-4">${renderPortfolioText(content)}</div>`
                : ""
            }
            ${
              projectUrl
                ? `
                  <div class="mt-8 flex flex-wrap gap-3">
                    <a href="${escapeHtml(projectUrl)}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full bg-[#001a3d] px-5 py-3 text-sm font-black uppercase tracking-[0.12em] text-white transition-colors hover:bg-[#ff6600]">
                      Open Project
                      <span aria-hidden="true">&rarr;</span>
                    </a>
                  </div>
                `
                : ""
            }
          </div>
        </div>
        ${
          canEmbedProject
            ? `
              <div class="border-t border-slate-200 bg-slate-50 p-4 md:p-6">
                <div class="mb-3 flex items-center justify-between gap-4">
                  <div>
                    <h3 class="text-lg font-black text-[#001a3d]">Live Preview</h3>
                    <p class="text-sm text-slate-500">If the preview does not load, open the project in a new tab.</p>
                  </div>
                </div>
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                  <iframe src="${escapeHtml(projectUrl)}" title="${escapeHtml(title || "Portfolio project preview")}" class="h-[70vh] w-full bg-white" loading="lazy"></iframe>
                </div>
              </div>
            `
            : ""
        }
      `;
    });
  });

  closeButton?.addEventListener("click", () => {
    modal.hidden = true;
  });
  modal?.addEventListener("click", (event) => {
    if (event.target === modal) modal.hidden = true;
  });
};

const initFaqPage = () => {
  $$("[data-faq-button]").forEach((button) => {
    button.addEventListener("click", () => {
      const panelId = button.getAttribute("data-faq-button");
      const panel = document.getElementById(panelId);
      if (!panel) return;
      const expanded = button.getAttribute("aria-expanded") === "true";

      $$("[data-faq-button]").forEach((item) => item.setAttribute("aria-expanded", "false"));
      $$(".faq-panel").forEach((item) => item.hidden = true);
      $$("[data-faq-button] iconify-icon").forEach((icon) => {
        icon.classList.remove("rotate-180", "text-[#ff6600]");
        icon.classList.add("text-gray-400");
      });

      if (!expanded) {
        button.setAttribute("aria-expanded", "true");
        panel.hidden = false;
        const icon = $("iconify-icon", button);
        if (icon) {
          icon.classList.add("rotate-180", "text-[#ff6600]");
          icon.classList.remove("text-gray-400");
        }
      }
    });
  });
};

const getRecaptchaToken = (form) => {
  if (!RECAPTCHA_ENABLED) return "recaptcha-disabled";
  const node = form.querySelector('textarea[name="g-recaptcha-response"]');
  return node?.value || "";
};

const initRecaptchaFallback = () => {
  if (RECAPTCHA_ENABLED) return;

  $$(".g-recaptcha").forEach((node) => {
    if (node.childElementCount > 0 || node.textContent.trim() !== "") return;
    node.innerHTML = '<span style="font-weight:700;color:#4b5563;letter-spacing:0.02em;">reCAPTCHA</span>';
  });
};

const initPhoneInputs = () => {
  $$('input[name="phone"]').forEach((input) => {
    input.setAttribute("inputmode", "numeric");
    input.setAttribute("autocomplete", "tel-national");
    input.setAttribute("pattern", "[0-9]*");

    const sanitize = () => {
      input.value = input.value.replace(/\D+/g, "");
    };

    input.addEventListener("input", sanitize);
    input.addEventListener("paste", () => {
      window.setTimeout(sanitize, 0);
    });
  });
};

const setButtonLoading = (form, loading, textWhenLoading) => {
  const button = $('button[type="submit"]', form);
  if (!button) return;
  if (!button.dataset.originalText) {
    button.dataset.originalText = button.textContent.trim();
  }
  button.disabled = loading;
  button.textContent = loading ? textWhenLoading : button.dataset.originalText;
};

const serializeContactForm = (form) => {
  const formData = new FormData();
  const phone = form.elements.phone?.value || "";
  const countryCode = form.elements.country_code?.value || "";
  formData.append("name", form.elements.name?.value || "");
  formData.append("email", form.elements.email?.value || "");
  formData.append("subject", form.elements.subject?.value || "");
  formData.append("message", form.elements.message?.value || "");
  formData.append("country_code", countryCode);
  if (phone) {
    formData.append("phone", phone);
  }
  formData.append("recaptcha", getRecaptchaToken(form));
  return formData;
};

const initForms = () => {
  $$("form").forEach((form) => {
    form.addEventListener("submit", async (event) => {
      event.preventDefault();

      const route = document.body.dataset.route || "";
      const isFresher = form.closest("#fresher-modal-shell");
      const isInternship = route === "/internship";
      const isContact =
        !isFresher &&
        !isInternship &&
        form.elements.name &&
        form.elements.email &&
        form.elements.subject &&
        form.elements.message;

      if (isFresher) {
        setButtonLoading(form, true, "Processing...");
        window.setTimeout(() => {
          alert("Application sent successfully!");
          form.reset();
          const nameNode = $("#fresher-file-name");
          if (nameNode) nameNode.textContent = "No file chosen";
          setButtonLoading(form, false, "Processing...");
          closeModal($("#fresher-modal-shell"));
        }, 1200);
        return;
      }

      if (isInternship) {
        if (!getRecaptchaToken(form)) {
          alert("Please complete the ReCAPTCHA");
          return;
        }
        setButtonLoading(form, true, "Sending...");
        window.setTimeout(() => {
          alert("Internship request submitted successfully!");
          form.reset();
          setButtonLoading(form, false, "Sending...");
        }, 1200);
        return;
      }

      if (isContact) {
        if (!getRecaptchaToken(form)) {
          alert("Please verify the captcha");
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
          } catch (error) {
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
          } catch (error) {
            // Ignore reCAPTCHA reset failures on routes without an active widget.
          }
        } catch (error) {
          alert(error.message || "error sending message");
        } finally {
          setButtonLoading(form, false, "sending...");
        }
      }
    });
  });
};

const initDeferredFeatures = () => {
  initTestimonials();
  initPortfoliosPage();
};

document.addEventListener("DOMContentLoaded", () => {
  initHeader();
  initForms();
  initPhoneInputs();
  initRecaptchaFallback();

  runWhenIdle(() => {
    initChatbot();
    initFresherModal();
    initVideoCards();
    initHeroSlider();
    initCertificationsSlider();
    initStatsCounters();
    initFaqPage();
    initDeferredFeatures();
  });
});
