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

const escapeHtmlAttribute = (value = "") => escapeHtml(value).replace(/'/g, "&#39;");

const portfolioFilterButtonClass = (active) =>
  `px-6 py-2 rounded-full text-sm font-bold transition-all border ${
    active
      ? "bg-[#001a3d] text-white border-[#001a3d]"
      : "bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200"
  }`;

const renderPortfolioCard = (item = {}) => {
  const title = String(item.title || "").trim() || "Portfolio Project";
  const imageUrl = String(item.image_url || "").trim();

  return `
    <button
      type="button"
      data-portfolio-item
      data-portfolio-title="${escapeHtmlAttribute(title)}"
      data-portfolio-image="${escapeHtmlAttribute(imageUrl)}"
      class="group relative overflow-hidden rounded-2xl aspect-[4/3] cursor-pointer bg-gray-100 shadow-sm text-left"
    >
      ${
        imageUrl
          ? `<img src="${escapeHtmlAttribute(imageUrl)}" class="w-full h-full object-cover transition-transform group-hover:scale-105" alt="${escapeHtmlAttribute(title)}" loading="lazy" decoding="async">`
          : `<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-700 px-6 text-center text-white font-bold">${escapeHtml(title)}</div>`
      }
      <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6">
        <h3 class="text-white font-bold">${escapeHtml(title)}</h3>
      </div>
    </button>
  `;
};

const renderPortfolioEmptyState = () => `
  <div class="col-span-full rounded-3xl border border-gray-200 bg-white px-6 py-16 text-center text-gray-500 shadow-sm">
    <h3 class="text-xl font-black text-[#001a3d]">No portfolio projects are available right now.</h3>
  </div>
`;

const renderPortfolioModalContent = ({ title, imageUrl }) => `
  <div class="overflow-y-auto max-h-[85vh]">
    ${
      imageUrl
        ? `<img src="${escapeHtmlAttribute(imageUrl)}" class="w-full" alt="${escapeHtmlAttribute(title)}">`
        : `<div class="min-h-[340px] flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-700 px-6 text-center text-2xl font-black text-white">${escapeHtml(title)}</div>`
    }
    <div class="p-6">
      <h2 class="text-2xl font-bold">${escapeHtml(title)}</h2>
    </div>
  </div>
`;

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
  $$("[data-video-src]").forEach((card) => {
    card.addEventListener("click", () => {
      const sourceUrl = card.getAttribute("data-video-src");
      const sourceType = card.getAttribute("data-video-type") || "file";
      const posterUrl = card.getAttribute("data-video-poster");
      const title = card.getAttribute("data-video-title") || "Sortiq video";
      if (!sourceUrl || card.dataset.loaded === "true") return;

      card.dataset.loaded = "true";

      if (sourceType === "youtube") {
        const autoplayUrl = `${sourceUrl}${sourceUrl.includes("?") ? "&" : "?"}autoplay=1&rel=0&modestbranding=1`;

        card.innerHTML = `
          <iframe
            src="${escapeHtml(autoplayUrl)}"
            title="${escapeHtml(title)}"
            class="w-full h-full border-0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy"
          ></iframe>
        `;

        return;
      }

      card.innerHTML = `
        <video
          src="${escapeHtml(sourceUrl)}"
          ${posterUrl ? `poster="${escapeHtml(posterUrl)}"` : ""}
          title="${escapeHtml(title)}"
          class="w-full h-full object-cover"
          controls
          autoplay
          playsinline
          preload="metadata"
        ></video>
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
    const viewport = $("[data-testimonial-viewport]", section);
    const track = $("[data-testimonial-track]", section);
    const panels = $$("[data-testimonial-panel]", section);
    const triggers = $$("[data-testimonial-trigger]", section);
    if (!viewport || !track || !panels.length || !triggers.length) return;

    let active = 0;
    let autoplayId = null;
    let isPaused = false;
    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    const centerActiveTrigger = () => {
      const activeTrigger = triggers[active];
      if (!activeTrigger) return;

      if (track.scrollWidth <= viewport.clientWidth) {
        track.style.transform = "translate3d(0, 0, 0)";
        return;
      }

      const offset = (viewport.clientWidth / 2) - (activeTrigger.offsetLeft + (activeTrigger.offsetWidth / 2));
      track.style.transform = `translate3d(${Math.round(offset)}px, 0, 0)`;
    };

    const render = () => {
      panels.forEach((panel, index) => {
        const isActive = index === active;
        panel.classList.toggle("is-active", isActive);
        panel.setAttribute("aria-hidden", String(!isActive));
      });

      triggers.forEach((trigger, index) => {
        const isActive = index === active;
        trigger.setAttribute("aria-pressed", String(isActive));
        trigger.classList.toggle("is-active", isActive);
      });

      centerActiveTrigger();
    };

    const stopAutoplay = () => {
      if (autoplayId !== null) {
        window.clearInterval(autoplayId);
        autoplayId = null;
      }
    };

    const startAutoplay = () => {
      if (prefersReducedMotion || panels.length < 2 || isPaused) return;

      stopAutoplay();
      autoplayId = window.setInterval(() => {
        active = (active + 1) % panels.length;
        render();
      }, 6500);
    };

    const moveTo = (nextIndex) => {
      active = (nextIndex + panels.length) % panels.length;
      render();
    };

    const pauseAutoplay = () => {
      isPaused = true;
      stopAutoplay();
    };

    const resumeAutoplay = () => {
      isPaused = false;
      startAutoplay();
    };

    triggers.forEach((button, index) => {
      button.addEventListener("click", () => {
        moveTo(index);
        startAutoplay();
      });

      button.addEventListener("keydown", (event) => {
        const currentIndex = Number(button.getAttribute("data-testimonial-index") || String(index));

        if (event.key === "ArrowRight") {
          event.preventDefault();
          moveTo(currentIndex + 1);
          triggers[active]?.focus();
        }

        if (event.key === "ArrowLeft") {
          event.preventDefault();
          moveTo(currentIndex - 1);
          triggers[active]?.focus();
        }
      });
    });

    section.addEventListener("mouseenter", pauseAutoplay);
    section.addEventListener("mouseleave", resumeAutoplay);
    section.addEventListener("focusin", pauseAutoplay);
    section.addEventListener("focusout", (event) => {
      if (event.relatedTarget instanceof Node && section.contains(event.relatedTarget)) return;
      resumeAutoplay();
    });

    window.addEventListener("resize", centerActiveTrigger);

    render();
    startAutoplay();
  });
};

const initPortfoliosPage = () => {
  const pageData = parseJsonScript("portfolio-page-data");
  const modal = $("#portfolio-modal");
  const contentNode = $("#portfolio-modal-content");
  const closeButton = $("#portfolio-modal-close");
  const grid = $("#portfolio-grid");
  const filterButtons = $$("[data-portfolio-filter]");
  const pagination = $("#portfolio-pagination");
  const previousButton = $("#portfolio-prev");
  const nextButton = $("#portfolio-next");
  const pageState = $("#portfolio-page-state");
  const behanceWrap = $("#portfolio-behance-wrap");
  if (!modal || !contentNode || !grid || !filterButtons.length) return;

  const items = Array.isArray(pageData?.items) ? pageData.items : [];
  const itemsPerPage = Number(pageData?.itemsPerPage || "6");
  let activeCategory = String(pageData?.activeCategory || "").trim() || "wordpress-development";
  let currentPage = 1;

  const closeModal = () => {
    modal.hidden = true;
    document.body.classList.remove("overflow-hidden");
    contentNode.innerHTML = "";
  };

  const openModal = (button) => {
    const title = button.getAttribute("data-portfolio-title")?.trim() || "Portfolio Project";
    const imageUrl = button.getAttribute("data-portfolio-image")?.trim() || "";

    modal.hidden = false;
    document.body.classList.add("overflow-hidden");
    contentNode.innerHTML = renderPortfolioModalContent({ title, imageUrl });
  };

  const bindPortfolioCardListeners = () => {
    $$("[data-portfolio-item]", grid).forEach((button) => {
      button.addEventListener("click", () => openModal(button));
    });
  };

  const filteredItems = () => items.filter((item) => String(item.category_slug || "").trim() === activeCategory);

  const updateFilterButtons = () => {
    filterButtons.forEach((button) => {
      const isActive = button.getAttribute("data-portfolio-filter") === activeCategory;
      button.className = portfolioFilterButtonClass(isActive);
    });
  };

  const updatePagination = (totalPages) => {
    if (!pagination || !previousButton || !nextButton || !pageState) return;

    if (totalPages <= 1) {
      pagination.classList.add("hidden");
      behanceWrap?.classList.add("pt-10");
      return;
    }

    pagination.classList.remove("hidden");
    behanceWrap?.classList.remove("pt-10");
    pageState.textContent = `${currentPage} / ${totalPages}`;
    previousButton.disabled = currentPage === 1;
    nextButton.disabled = currentPage === totalPages;
  };

  const renderPortfolioPage = () => {
    const categoryItems = filteredItems();
    const totalPages = Math.ceil(categoryItems.length / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const visibleItems = categoryItems.slice(startIndex, startIndex + itemsPerPage);

    grid.innerHTML = visibleItems.length
      ? visibleItems.map((item) => renderPortfolioCard(item)).join("")
      : renderPortfolioEmptyState();

    updateFilterButtons();
    updatePagination(totalPages);
    bindPortfolioCardListeners();
  };

  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const category = button.getAttribute("data-portfolio-filter");
      if (!category || category === activeCategory) return;

      activeCategory = category;
      currentPage = 1;
      renderPortfolioPage();
    });
  });

  previousButton?.addEventListener("click", () => {
    if (currentPage === 1) return;

    currentPage -= 1;
    renderPortfolioPage();
  });

  nextButton?.addEventListener("click", () => {
    const totalPages = Math.ceil(filteredItems().length / itemsPerPage);
    if (currentPage >= totalPages) return;

    currentPage += 1;
    renderPortfolioPage();
  });

  closeButton?.addEventListener("click", closeModal);
  modal.addEventListener("click", (event) => {
    if (event.target === modal) closeModal();
  });
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && !modal.hidden) closeModal();
  });

  renderPortfolioPage();
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
