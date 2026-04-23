const runtimeDataset = document.body?.dataset ?? {};
const CONTACT_API_URL = runtimeDataset.contactApiUrl || "/api/contact-messages";
const WHATSAPP_NUMBER = String(runtimeDataset.whatsappNumber || "919646522110").replace(/\D+/g, "");
const RECAPTCHA_ENABLED = runtimeDataset.recaptchaEnabled !== "false";
const BLOG_FEED_URL = "/blog/feed.json";

const $ = (selector, root = document) => root.querySelector(selector);
const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

const decodeHtml = (value = "") => {
  const textarea = document.createElement("textarea");
  textarea.innerHTML = value;
  return textarea.value;
};

const stripHtml = (value = "") => decodeHtml(String(value).replace(/<[^>]*>/g, " ")).replace(/\s+/g, " ").trim();

const formatDate = (value) => {
  if (!value) return "March 2026";
  const date = new Date(value);
  if (Number.isNaN(date.getTime())) return value;
  return date.toLocaleDateString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
};

const escapeHtml = (value = "") =>
  String(value)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");

const normalizeAssetUrl = (value = "") => {
  const url = String(value || "").trim();

  if (!url) return "";
  if (url.startsWith("http://") || url.startsWith("https://") || url.startsWith("//")) return url;
  if (url.startsWith("/frontend-assets/")) return url;
  if (url.startsWith("/assets/")) return url.replace("/assets/", "/frontend-assets/");
  if (url.startsWith("assets/")) return `/${url.replace(/^assets\//, "frontend-assets/")}`;

  return url.startsWith("/") ? url : `/${url}`;
};

const parseJsonScript = (id) => {
  const node = document.getElementById(id);
  if (!node) return null;

  try {
    return JSON.parse(node.textContent);
  } catch (error) {
    return null;
  }
};

const fetchJson = async (localUrl) => {
  try {
    const localResponse = await fetch(localUrl, { cache: "no-store" });
    if (localResponse.ok) {
      return await localResponse.json();
    }
  } catch (error) {
    // Ignore fetch failures and return an empty dataset to the caller.
  }

  return [];
};

const normalizeBlogs = (raw) => {
  if (Array.isArray(raw)) return raw;
  if (Array.isArray(raw?.posts)) return raw.posts;
  if (Array.isArray(raw?.blogs)) return raw.blogs;
  return [];
};

const normalizeReviews = (raw) => {
  if (Array.isArray(raw)) return raw;
  if (Array.isArray(raw?.reviews)) return raw.reviews;
  return [];
};

const normalizePortfolios = (raw) => {
  if (Array.isArray(raw)) return raw;
  if (Array.isArray(raw?.portfolios)) return raw.portfolios;
  return [];
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

const getBlogTitle = (blog) =>
  typeof blog?.title === "string" ? blog.title : blog?.title?.rendered || "Untitled";

const getBlogCategory = (blog) => {
  if (Array.isArray(blog?.categories) && blog.categories.length > 0) {
    if (typeof blog.categories[0] === "string") return blog.categories[0];
    return blog.categories[0]?.name || blog.categories[0]?.slug || "Tech";
  }

  if (Array.isArray(blog?.category_names) && blog.category_names.length > 0) {
    return blog.category_names[0];
  }

  return "Tech";
};

const renderBlogCard = (blog) => {
  const imageUrl = normalizeAssetUrl(
    blog.featured_media_url ||
    blog.featured_image_url ||
    blog.featured_image ||
    blog.image ||
    blog.thumbnail ||
    blog.yoast_head_json?.og_image?.[0]?.url ||
    ""
  );
  const title = getBlogTitle(blog);
  const excerpt = blog.excerpt?.rendered
    ? stripHtml(blog.excerpt.rendered)
    : stripHtml(blog.excerpt || "Click to read more about our latest updates and insights.");
  const dateText = formatDate(blog.date);
  const category = getBlogCategory(blog);
  const href = blog.slug ? `/blog/${blog.slug}` : "/blog";

  return `
    <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 group flex flex-col h-full">
      <a href="${href}" class="relative overflow-hidden rounded-t-2xl h-60 w-full bg-gray-200 block">
        ${
          imageUrl
            ? `<img src="${escapeHtml(imageUrl)}" alt="${escapeHtml(title)}" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">`
            : `<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#002d5b] to-[#004080]"><span class="text-white text-sm font-semibold px-4 text-center opacity-70 line-clamp-3">${escapeHtml(title)}</span></div>`
        }
        <div class="absolute top-4 left-4 bg-[#ff6a00] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">${escapeHtml(category)}</div>
      </a>
      <div class="p-8 flex flex-col flex-grow">
        <p class="text-gray-400 text-xs mb-3 font-medium">${escapeHtml(dateText)}</p>
        <h3 class="text-xl font-bold text-[#002d5b] mb-4 line-clamp-2 leading-tight group-hover:text-[#ff6a00] transition-colors">
          <a href="${href}">${escapeHtml(title)}</a>
        </h3>
        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6">${escapeHtml(excerpt)}</p>
        <div class="mt-auto">
          <a href="${href}" class="text-[#ff6a00] font-bold text-sm inline-flex items-center gap-2 group/btn">
            Read More
            <span class="group-hover/btn:translate-x-2 transition-transform duration-300">&rarr;</span>
          </a>
        </div>
      </div>
    </article>
  `;
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

const initNetworkSlider = () => {
  const track = $("#network-track");
  const data = parseJsonScript("network-logos-data");
  if (!track || !data?.logos?.length) return;

  let index = 0;
  const getVisibleCount = () => {
    if (window.innerWidth >= 1280) return 4;
    if (window.innerWidth >= 768) return 3;
    if (window.innerWidth >= 480) return 2;
    return 1;
  };

  const render = () => {
    const visibleCount = getVisibleCount();
    const maxIndex = Math.max(data.logos.length - visibleCount, 0);
    const step = 100 / visibleCount;
    if (index > maxIndex) index = 0;
    track.style.transform = `translateX(-${index * step}%)`;
  };

  window.setInterval(() => {
    const visibleCount = getVisibleCount();
    const maxIndex = Math.max(data.logos.length - visibleCount, 0);
    index = index >= maxIndex ? 0 : index + 1;
    render();
  }, 2500);

  window.addEventListener("resize", render, { passive: true });
  render();
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

const initials = (name) => {
  if (!name) return "S";
  const parts = name.trim().split(/\s+/);
  if (parts.length < 2) return (parts[0][0] || "S").toUpperCase();
  return `${parts[0][0] || ""}${parts[parts.length - 1][0] || ""}`.toUpperCase();
};

const buildTestimonialsMarkup = (testimonials, activeIndex) => {
  if (!testimonials.length) return "";

  const current = testimonials[activeIndex];
  const previousIndex = (activeIndex - 1 + testimonials.length) % testimonials.length;
  const nextIndex = (activeIndex + 1) % testimonials.length;
  const visible = [
    { ...testimonials[previousIndex], originalIndex: previousIndex, position: "side" },
    { ...current, originalIndex: activeIndex, position: "center" },
    { ...testimonials[nextIndex], originalIndex: nextIndex, position: "side" },
  ];

  return `
    <div class="mb-12">
      <h2 class="text-[32px] md:text-[46px] font-extrabold text-[#002d5b] tracking-tight">Client Success Stories</h2>
      <div class="w-16 h-1 bg-[#ff6a00] mx-auto mt-4 rounded-full"></div>
    </div>
    <div class="max-w-4xl mx-auto relative">
      <div class="bg-white rounded-[2.5rem] p-8 md:p-14 shadow-[0_20px_50px_rgba(0,45,91,0.04)] border border-gray-50 min-h-[250px] flex items-center justify-center">
        <p class="text-[#334155] text-xl md:text-2xl italic font-medium leading-relaxed">&ldquo; ${escapeHtml(current.text)} &rdquo;</p>
      </div>
      <div class="relative flex justify-center">
        <div class="w-8 h-8 bg-white rotate-45 -mt-4 border-r border-b border-gray-50"></div>
      </div>
    </div>
    <div class="max-w-5xl mx-auto flex justify-center items-center gap-4 md:gap-16 mt-12">
      ${visible.map((person) => {
        const isCenter = person.position === "center";
        return `
          <button data-testimonial-index="${person.originalIndex}" class="flex items-center gap-4 cursor-pointer ${!isCenter ? "hidden sm:flex opacity-30 grayscale" : ""}">
            <div class="relative w-14 h-14 md:w-24 md:h-24 rounded-full flex items-center justify-center ${isCenter ? "bg-[#002d5b] ring-[6px] ring-[#ff6a00] testimonial-avatar-ring" : "bg-slate-300"}">
              <span class="font-bold ${isCenter ? "text-white text-2xl md:text-3xl" : "text-gray-100 text-base"}">${escapeHtml(initials(person.name))}</span>
              ${isCenter ? '<span class="absolute -top-1 -right-1 w-5 h-5 bg-[#ff6a00] border-2 border-white rounded-full animate-bounce"></span>' : ""}
            </div>
            <div class="text-left">
              <span class="block text-lg md:text-xl font-black ${isCenter ? "text-[#002d5b]" : "text-[#b2becd]"}">${escapeHtml(person.name)}</span>
              ${isCenter ? '<div class="flex items-center gap-1"><span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span><span class="text-[#ff6a00] text-[10px] font-black uppercase tracking-widest">Verified Client</span></div>' : ""}
            </div>
          </button>
        `;
      }).join("")}
    </div>
  `;
};

const loadReviewsData = async () => normalizeReviews(parseJsonScript("reviews-data"));

const initTestimonials = async () => {
  const sections = $$("[data-testimonials-section]");
  if (!sections.length) return;

  const reviews = await loadReviewsData();
  const testimonials = reviews.map((item) => ({
    name: item.title || "Happy Client",
    text: stripHtml(item.content || item.post_content || ""),
  })).filter((item) => item.text);

  sections.forEach((section) => {
    if (!testimonials.length) {
      section.innerHTML = "";
      return;
    }

    let activeIndex = 0;
    const render = () => {
      section.innerHTML = buildTestimonialsMarkup(testimonials, activeIndex);
      $$("[data-testimonial-index]", section).forEach((button) => {
        button.addEventListener("click", () => {
          activeIndex = Number(button.getAttribute("data-testimonial-index") || "0");
          render();
        });
      });
    };

    render();
    window.setInterval(() => {
      activeIndex = (activeIndex + 1) % testimonials.length;
      render();
    }, 7000);
  });
};

const loadBlogsData = async () => normalizeBlogs(await fetchJson(BLOG_FEED_URL));

const initBlogInsights = async () => {
  const grid = $("#blog-insights-grid");
  if (!grid) return;

  const blogs = await loadBlogsData();
  const posts = blogs.slice(0, 3);

  if (!posts.length) {
    grid.innerHTML = '<div class="md:col-span-3 py-24 text-center text-gray-400 font-medium min-h-[200px]"><p class="text-lg">No insights available at the moment.</p></div>';
    return;
  }

  grid.innerHTML = posts.map(renderBlogCard).join("");
};

const initBlogPage = async () => {
  const feed = $("#blog-feed");
  if (!feed) return;

  const pagination = $("#blog-pagination");
  const recent = $("#blog-recent-posts");
  const searchInput = $("#blog-search-input");
  const categories = $$("[data-blog-category]");
  const clearFilter = $("#blog-clear-filter");
  const state = {
    posts: [],
    page: 1,
    perPage: 9,
    activeCategory: null,
    searchTerm: "",
  };

  state.posts = await loadBlogsData();

  const render = () => {
    const filtered = state.posts.filter((post) => {
      const categoryMatches = !state.activeCategory ||
        (Array.isArray(post.categories) && post.categories.some((item) => {
          if (typeof item === "string") return item === state.activeCategory;
          return item?.slug === state.activeCategory;
        }));

      const text = `${getBlogTitle(post)} ${stripHtml(post.excerpt?.rendered || post.excerpt || "")}`.toLowerCase();
      const searchMatches = !state.searchTerm || text.includes(state.searchTerm.toLowerCase());
      return categoryMatches && searchMatches;
    });

    const totalPages = Math.max(Math.ceil(filtered.length / state.perPage), 1);
    if (state.page > totalPages) state.page = totalPages;
    const start = (state.page - 1) * state.perPage;
    const pageItems = filtered.slice(start, start + state.perPage);

    feed.innerHTML = pageItems.length
      ? pageItems.map(renderBlogCard).join("")
      : '<div class="col-span-full py-20 text-center text-gray-500 font-bold bg-white rounded-lg shadow-sm border border-gray-100">No blogs found in this category.</div>';

    if (recent) {
      recent.innerHTML = filtered.slice(0, 5).map((post) => `
        <li class="group cursor-pointer">
          <a href="${post.slug ? `/blog/${post.slug}/` : "/blog/"}" class="text-sm font-semibold text-gray-600 group-hover:text-[#ff6600] transition-colors line-clamp-2 leading-snug">&bull; ${escapeHtml(getBlogTitle(post))}</a>
          <div class="h-[1px] w-0 group-hover:w-full bg-orange-100 transition-all duration-300 mt-2"></div>
        </li>
      `).join("");
    }

    if (pagination) {
      pagination.innerHTML = totalPages > 1 ? `
        <button data-blog-page="${state.page - 1}" ${state.page === 1 ? "disabled" : ""} class="w-10 h-10 rounded-full flex items-center justify-center border bg-white disabled:opacity-30 text-[#ff6600] hover:bg-orange-50 transition-colors">&#8249;</button>
        ${Array.from({ length: totalPages }, (_, index) => `
          <button data-blog-page="${index + 1}" class="w-10 h-10 rounded-full font-bold text-sm transition-all border ${
            state.page === index + 1
              ? "bg-[#ff6600] text-white border-[#ff6600]"
              : "bg-white text-gray-500 border-gray-200 hover:border-[#ff6600] hover:text-[#ff6600]"
          }">${index + 1}</button>
        `).join("")}
        <button data-blog-page="${state.page + 1}" ${state.page === totalPages ? "disabled" : ""} class="w-10 h-10 rounded-full flex items-center justify-center border bg-white disabled:opacity-30 text-[#ff6600] hover:bg-orange-50 transition-colors">&#8250;</button>
      ` : "";

      $$("[data-blog-page]", pagination).forEach((button) => {
        button.addEventListener("click", () => {
          const nextPage = Number(button.getAttribute("data-blog-page") || "1");
          if (nextPage < 1 || nextPage > totalPages) return;
          state.page = nextPage;
          render();
          window.scrollTo({ top: 0, behavior: "smooth" });
        });
      });
    }

    categories.forEach((button) => {
      const slug = button.getAttribute("data-blog-category");
      const active = slug === state.activeCategory;
      button.className = `flex justify-between text-sm font-bold cursor-pointer transition-colors py-1 group ${
        active ? "text-[#ff6600]" : "text-gray-600 hover:text-[#ff6600]"
      }`;
      const dot = $(".blog-category-dot", button);
      if (dot) {
        dot.className = `blog-category-dot w-1.5 h-1.5 rounded-full ${active ? "bg-[#ff6600]" : "bg-gray-300 group-hover:bg-[#ff6600]"}`;
      }
    });

    if (clearFilter) {
      clearFilter.classList.toggle("hidden", !state.activeCategory);
    }
  };

  categories.forEach((button) => {
    button.addEventListener("click", () => {
      state.activeCategory = button.getAttribute("data-blog-category");
      state.page = 1;
      render();
    });
  });

  clearFilter?.addEventListener("click", () => {
    state.activeCategory = null;
    state.page = 1;
    render();
  });

  searchInput?.addEventListener("input", () => {
    state.searchTerm = searchInput.value.trim();
    state.page = 1;
    render();
  });

  render();
};

const renderReviewCard = (item) => `
  <div class="group bg-white rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 p-8 flex flex-col relative transition-all duration-500 hover:shadow-[0_25px_60px_-15px_rgba(255,102,0,0.12)] hover:-translate-y-3">
    <div class="absolute -top-5 left-8 w-12 h-12 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-200 group-hover:rotate-12 transition-transform duration-500">"</div>
    <div class="mt-6 mb-8 flex-grow">
      <div class="text-slate-600 font-medium leading-relaxed text-sm md:text-base line-clamp-8 group-hover:line-clamp-none transition-all duration-500">${item.content || item.post_content || ""}</div>
    </div>
    <div class="border-t border-dashed border-gray-100 pt-6 mt-auto flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <h4 class="font-black text-slate-900 text-[17px] tracking-tight group-hover:text-orange-600 transition-colors">${escapeHtml(item.title || "Verified Client")}</h4>
        <div class="flex text-yellow-400 text-xs mt-1 space-x-0.5">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      </div>
      <div class="bg-gray-50 px-4 py-2 rounded-2xl border border-gray-100 self-end sm:self-auto">
        ${
          String(item.platform || "").toLowerCase() === "fiverr"
            ? '<img src="https://sortiqsolutions.com/wp-content/uploads/2026/01/image-4.png" alt="Fiverr" class="h-5 w-auto grayscale group-hover:grayscale-0 transition-all duration-500">'
            : '<span class="text-[#37a000] font-black text-sm tracking-tighter flex items-center gap-1">upwork <span class="w-1.5 h-1.5 rounded-full bg-[#37a000] animate-pulse"></span></span>'
        }
      </div>
    </div>
  </div>
`;

const initReviewsPage = async () => {
  const grid = $("#reviews-grid");
  if (!grid) return;

  const loading = $("#reviews-loading");
  const pagination = $("#reviews-pagination");
  const reviews = await loadReviewsData();
  const state = {
    page: 1,
    perPage: 9,
  };

  const render = () => {
    const totalPages = Math.max(Math.ceil(reviews.length / state.perPage), 1);
    const start = (state.page - 1) * state.perPage;
    const items = reviews.slice(start, start + state.perPage);
    loading?.classList.add("hidden");
    grid.innerHTML = items.map(renderReviewCard).join("");

    if (!pagination) return;
    pagination.innerHTML = totalPages > 1 ? `
      <button data-reviews-page="${state.page - 1}" ${state.page === 1 ? "disabled" : ""} class="p-3 rounded-full transition-all ${state.page === 1 ? "text-gray-300 cursor-not-allowed" : "text-[#001a3d] hover:bg-white hover:shadow-md"}">&#8249;</button>
      <div class="flex px-4 gap-2">
        ${Array.from({ length: totalPages }, (_, index) => `
          <button data-reviews-page="${index + 1}" class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-black transition-all ${
            state.page === index + 1 ? "bg-[#001a3d] text-white shadow-lg" : "text-gray-400 hover:text-[#001a3d]"
          }">${index + 1}</button>
        `).join("")}
      </div>
      <button data-reviews-page="${state.page + 1}" ${state.page === totalPages ? "disabled" : ""} class="p-3 rounded-full transition-all ${state.page === totalPages ? "text-gray-300 cursor-not-allowed" : "text-[#001a3d] hover:bg-white hover:shadow-md"}">&#8250;</button>
    ` : "";

    $$("[data-reviews-page]", pagination).forEach((button) => {
      button.addEventListener("click", () => {
        const nextPage = Number(button.getAttribute("data-reviews-page") || "1");
        if (nextPage < 1 || nextPage > totalPages) return;
        state.page = nextPage;
        render();
        window.scrollTo({ top: 0, behavior: "smooth" });
      });
    });
  };

  render();
};

const loadPortfoliosData = async () => normalizePortfolios(parseJsonScript("portfolio-items-data"));

const initPortfoliosPage = async () => {
  const grid = $("#portfolio-grid");
  if (!grid) return;

  const filterButtons = $$("[data-portfolio-category]");
  const pagination = $("#portfolio-pagination");
  const modal = $("#portfolio-modal");
  const modalContent = $("#portfolio-modal-content");
  const closeButton = $("#portfolio-modal-close");
  const loading = $("#portfolio-loading");
  const allData = await loadPortfoliosData();
  const availableCategories = Array.from(new Set(
    allData.flatMap((item) =>
      Array.isArray(item.categories)
        ? item.categories.map((category) => category?.slug).filter(Boolean)
        : []
    )
  ));
  const state = {
    activeSlug: "all",
    page: 1,
    perPage: 6,
  };

  const render = () => {
    if (state.activeSlug !== "all" && availableCategories.length && !availableCategories.includes(state.activeSlug)) {
      state.activeSlug = "all";
    }

    const filtered = state.activeSlug && state.activeSlug !== "all"
      ? allData.filter((item) =>
        Array.isArray(item.categories) && item.categories.some((cat) => cat.slug === state.activeSlug)
      )
      : allData;
    const totalPages = Math.max(Math.ceil(filtered.length / state.perPage), 1);
    if (state.page > totalPages) state.page = totalPages;
    const items = filtered.slice((state.page - 1) * state.perPage, state.page * state.perPage);

    loading?.classList.add("hidden");
    grid.innerHTML = items.length
      ? items.map((item) => `
        <button data-portfolio-item="${escapeHtml(String(item.id))}" class="group relative overflow-hidden rounded-2xl aspect-[4/3] cursor-pointer bg-gray-100 shadow-sm text-left">
          <img src="${escapeHtml(normalizeAssetUrl(item.featured_media_url || ""))}" class="w-full h-full object-cover transition-transform group-hover:scale-105" alt="${escapeHtml(item.title || "")}">
          <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6">
            <h3 class="text-white font-bold">${escapeHtml(item.title || "")}</h3>
          </div>
        </button>
      `).join("")
      : `
        <div class="col-span-full rounded-3xl border border-gray-200 bg-white px-6 py-16 text-center text-gray-500 shadow-sm">
          <h3 class="text-xl font-black text-[#001a3d]">No portfolio projects available yet.</h3>
          <p class="mx-auto mt-3 max-w-2xl text-sm leading-6">
            Portfolio items will appear here after the live database is connected and published projects are added.
          </p>
        </div>
      `;

    filterButtons.forEach((button) => {
      const active = button.getAttribute("data-portfolio-category") === state.activeSlug;
      button.className = `px-6 py-2 rounded-full text-sm font-bold transition-all border ${
        active
          ? "bg-[#001a3d] text-white border-[#001a3d]"
          : "bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200"
      }`;
    });

    if (pagination) {
      pagination.innerHTML = totalPages > 1 ? `
        <button data-portfolio-page="${state.page - 1}" ${state.page === 1 ? "disabled" : ""} class="p-2 border rounded-full disabled:opacity-20 hover:bg-gray-50 transition-colors">&#8249;</button>
        <span class="font-bold text-gray-600">${state.page} / ${totalPages}</span>
        <button data-portfolio-page="${state.page + 1}" ${state.page === totalPages ? "disabled" : ""} class="p-2 border rounded-full disabled:opacity-20 hover:bg-gray-50 transition-colors">&#8250;</button>
      ` : "";

      $$("[data-portfolio-page]", pagination).forEach((button) => {
        button.addEventListener("click", () => {
          const nextPage = Number(button.getAttribute("data-portfolio-page") || "1");
          if (nextPage < 1 || nextPage > totalPages) return;
          state.page = nextPage;
          render();
        });
      });
    }

    $$("[data-portfolio-item]", grid).forEach((button) => {
      button.addEventListener("click", () => {
        const id = button.getAttribute("data-portfolio-item");
        const item = allData.find((entry) => String(entry.id) === id);
        if (!item || !modal || !modalContent) return;
        const projectUrl = normalizeWebsiteUrl(item.website_url || "");
        const canEmbedProject = isEmbeddablePortfolioUrl(projectUrl);
        const summary = String(item.summary || "").trim();
        const content = String(item.content || "").trim();
        const category = Array.isArray(item.categories) && item.categories.length > 0
          ? item.categories[0]?.name || item.categories[0]?.slug || "Portfolio"
          : "Portfolio";
        modal.hidden = false;
        modalContent.innerHTML = `
          <div class="grid lg:grid-cols-[minmax(0,1.05fr)_minmax(320px,0.95fr)]">
            <div class="bg-slate-950">
              <img src="${escapeHtml(normalizeAssetUrl(item.featured_media_url || ""))}" class="w-full h-full object-cover min-h-[280px]" alt="${escapeHtml(item.title || "")}">
            </div>
            <div class="p-6 md:p-8">
              <div class="inline-flex items-center rounded-full bg-orange-50 px-3 py-1 text-xs font-black uppercase tracking-[0.18em] text-[#ff6600]">${escapeHtml(category)}</div>
              <h2 class="mt-4 text-2xl md:text-3xl font-black text-[#001a3d]">${escapeHtml(item.title || "")}</h2>
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
                    <iframe src="${escapeHtml(projectUrl)}" title="${escapeHtml(item.title || "Portfolio project preview")}" class="h-[70vh] w-full bg-white" loading="lazy"></iframe>
                  </div>
                </div>
              `
              : ""
          }
        `;
      });
    });
  };

  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      state.activeSlug = button.getAttribute("data-portfolio-category");
      state.page = 1;
      render();
    });
  });

  closeButton?.addEventListener("click", () => {
    if (modal) modal.hidden = true;
  });
  modal?.addEventListener("click", (event) => {
    if (event.target === modal) modal.hidden = true;
  });

  render();
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

const initClientsPage = () => {
  const root = $("#clients-page");
  const grid = $("#clients-grid");
  const data = parseJsonScript("clients-pages-data");
  if (!root || !grid || !data?.pages?.length) return;

  const state = { page: 0 };

  const render = () => {
    const current = data.pages[state.page] || [];
    grid.className = `grid ${state.page === 2 ? "grid-cols-2 md:grid-cols-5" : "grid-cols-2 md:grid-cols-4"} gap-6 min-h-[400px] items-center transition-all duration-500`;
    grid.innerHTML = current.map((logo) => `
      <div class="client-grid-logo group flex items-center justify-center p-4 border border-gray-100 rounded-xl bg-gray-50/30 hover:bg-white hover:shadow-xl hover:border-orange-100 transition-all duration-500 h-32">
        <img src="${escapeHtml(logo.url)}" alt="Client Logo" class="max-h-full max-w-full grayscale group-hover:grayscale-0 opacity-70 group-hover:opacity-100 transition-all duration-500 object-contain">
      </div>
    `).join("");

    $$("[data-clients-page]").forEach((button) => {
      const index = Number(button.getAttribute("data-clients-page") || "0");
      button.className = `w-12 h-12 rounded-full font-bold text-lg border transition-all ${
        state.page === index
          ? "bg-orange-500 border-orange-500 text-white shadow-lg scale-110"
          : "bg-white border-gray-200 text-gray-400 hover:text-orange-500 hover:border-orange-500"
      }`;
    });

    const prev = $("#clients-prev");
    const next = $("#clients-next");
    if (prev) prev.classList.toggle("invisible", state.page === 0);
    if (next) next.classList.toggle("invisible", state.page === data.pages.length - 1);
  };

  $$("[data-clients-page]").forEach((button) => {
    button.addEventListener("click", () => {
      state.page = Number(button.getAttribute("data-clients-page") || "0");
      render();
    });
  });

  $("#clients-prev")?.addEventListener("click", () => {
    if (state.page === 0) return;
    state.page -= 1;
    render();
  });

  $("#clients-next")?.addEventListener("click", () => {
    if (state.page >= data.pages.length - 1) return;
    state.page += 1;
    render();
  });

  render();
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

const initAsyncFeatures = () =>
  Promise.allSettled([
    initTestimonials(),
    initBlogInsights(),
    initReviewsPage(),
    initPortfoliosPage(),
  ]);

document.addEventListener("DOMContentLoaded", () => {
  initHeader();
  initChatbot();
  initFresherModal();
  initVideoCards();
  initHeroSlider();
  initNetworkSlider();
  initCertificationsSlider();
  initStatsCounters();
  initFaqPage();
  initClientsPage();
  initForms();
  initPhoneInputs();
  initRecaptchaFallback();

  void initAsyncFeatures();
});
