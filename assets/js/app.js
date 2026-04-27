(() => {
  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));
  const normalize = (s) => (s || "").toLowerCase().trim();

  // ---------------------------
  // Mobile menu
  // ---------------------------
  const burger = $('[data-burger]');
  const nav = $('[data-nav]');
  if (burger && nav) {
    const setExpanded = (v) => burger.setAttribute('aria-expanded', v ? 'true' : 'false');

    burger.addEventListener('click', () => {
      const open = !nav.classList.contains('is-open');
      nav.classList.toggle('is-open', open);
      setExpanded(open);
    });

    $$('a', nav).forEach(a =>
      a.addEventListener('click', () => {
        nav.classList.remove('is-open');
        setExpanded(false);
      })
    );
  }

  // ---------------------------
  // Smooth anchors (safe)
  // ---------------------------
  const reduced = window.matchMedia?.('(prefers-reduced-motion: reduce)')?.matches;

  $$('a[href^="#"]').forEach(a => {
    a.addEventListener('click', (e) => {
      const href = a.getAttribute('href');

      // ignore empty anchors and placeholders
      if (!href || href === '#' || href.length < 2) return;

      let el = null;
      try {
        el = document.querySelector(href);
      } catch {
        return;
      }
      if (!el) return;

      e.preventDefault();
      el.scrollIntoView({ behavior: reduced ? 'auto' : 'smooth', block: 'start' });
      history.pushState(null, '', href);
    });
  });

  // ---------------------------
  // FAQ category accordion (generic)
  // ---------------------------
  $$('[data-faq-cat]').forEach(btn => {
    btn.addEventListener('click', () => {
      const body = btn.parentElement?.querySelector('.faq-cat__body');
      const icon = btn.querySelector('.faq-cat__icon');
      if (!body) return;

      const closed = body.hasAttribute('hidden');
      if (closed) body.removeAttribute('hidden');
      else body.setAttribute('hidden', '');

      if (icon) icon.textContent = closed ? '–' : '+';
    });
  });

  // ---------------------------
  // FAQ Q/A accordion (generic)
  // ---------------------------
  $$('[data-faq-q]').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      const ans = item?.querySelector('.faq-a');
      const icon = btn.querySelector('.faq-icon');
      if (!ans) return;

      const expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');

      if (expanded) ans.setAttribute('hidden', '');
      else ans.removeAttribute('hidden');

      if (icon) icon.textContent = expanded ? '+' : '–';
    });
  });

  // ---------------------------
  // "On this page" dropdown
  // ---------------------------
  const navDdToggle = $('[data-nav-dd-toggle]');
  const navDdMenu = $('[data-nav-dd-menu]');
  const navDdWrap = $('[data-nav-dd]');

  if (navDdToggle && navDdMenu && navDdWrap) {
    const close = () => {
      navDdMenu.setAttribute('hidden', '');
      navDdToggle.setAttribute('aria-expanded', 'false');
    };
    const open = () => {
      navDdMenu.removeAttribute('hidden');
      navDdToggle.setAttribute('aria-expanded', 'true');
    };

    close();

    navDdToggle.addEventListener('click', (e) => {
      e.preventDefault();
      const isOpen = !navDdMenu.hasAttribute('hidden');
      isOpen ? close() : open();
    });

    document.addEventListener('click', (e) => {
      if (!navDdWrap.contains(e.target)) close();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') close();
    });
  }

  // ---------------------------
  // Language dropdown
  // ---------------------------
  const langToggle = $('[data-lang-toggle]');
  const langMenu = $('[data-lang-menu]');
  const langWrap = $('[data-lang-switch]');

  if (langToggle && langMenu && langWrap) {
    const close = () => {
      langMenu.setAttribute('hidden', '');
      langToggle.setAttribute('aria-expanded', 'false');
    };
    const open = () => {
      langMenu.removeAttribute('hidden');
      langToggle.setAttribute('aria-expanded', 'true');
    };

    close();

    langToggle.addEventListener('click', (e) => {
      e.preventDefault();
      const isOpen = !langMenu.hasAttribute('hidden');
      isOpen ? close() : open();
    });

    document.addEventListener('click', (e) => {
      if (!langWrap.contains(e.target)) close();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') close();
    });
  }

  // ---------------------------
  // SERVICES: filter + details icon sync
  // ---------------------------
  const serviceSearch = $('[data-service-search]');
  const serviceCards = $$('[data-service-card]');

  if (serviceSearch && serviceCards.length) {
    const apply = () => {
      const q = normalize(serviceSearch.value);

      serviceCards.forEach(card => {
        const text = normalize(card.getAttribute('data-service-text') || '');
        const match = !q || text.includes(q);

        card.classList.toggle('is-hidden', !match);

        // Auto-close non-matching open details
        const details = card.querySelector('details');
        if (!match && details?.open) details.open = false;
      });
    };

    serviceSearch.addEventListener('input', apply);
    apply();

    // Keep +/- icon consistent even when toggled by keyboard
    serviceCards.forEach(card => {
      const details = card.querySelector('details');
      const icon = card.querySelector('.service-summary__icon');
      if (!details || !icon) return;

      const sync = () => { icon.textContent = details.open ? '–' : '+'; };
      details.addEventListener('toggle', sync);
      sync();
    });
  }

  // ---------------------------
  // STAFF: filter + expand/collapse + details icon sync
  // ---------------------------
  const staffSearch = $('[data-staff-search]');
  const staffCards = $$('[data-staff-card]');
  const staffExpandAll = $('[data-staff-expand-all]');
  const staffCollapseAll = $('[data-staff-collapse-all]');

  if ((staffSearch || staffExpandAll || staffCollapseAll) && staffCards.length) {
    const getAccordions = (card) => Array.from(card.querySelectorAll('details[data-staff-acc]'));

    const syncIcon = (detailsEl) => {
      const icon = detailsEl.querySelector('.staff-acc__icon');
      if (!icon) return;
      icon.textContent = detailsEl.open ? '–' : '+';
    };

    // Sync icons on all staff accordions
    staffCards.forEach(card => {
      getAccordions(card).forEach(detailsEl => {
        const handler = () => syncIcon(detailsEl);
        detailsEl.addEventListener('toggle', handler);
        handler();
      });
    });

    // Search filter (uses data-staff-text)
    if (staffSearch) {
      const apply = () => {
        const q = normalize(staffSearch.value);

        staffCards.forEach(card => {
          const text = normalize(card.getAttribute('data-staff-text') || '');
          const match = !q || text.includes(q);

          card.classList.toggle('is-hidden', !match);

          // close accordions on non-matching to keep layout tidy
          if (!match) {
            getAccordions(card).forEach(d => { if (d.open) d.open = false; });
          }
        });
      };

      staffSearch.addEventListener('input', apply);
      apply();
    }

    // Expand all
    if (staffExpandAll) {
      staffExpandAll.addEventListener('click', () => {
        staffCards.forEach(card => {
          if (card.classList.contains('is-hidden')) return;
          getAccordions(card).forEach(d => { d.open = true; });
        });
      });
    }

    // Collapse all
    if (staffCollapseAll) {
      staffCollapseAll.addEventListener('click', () => {
        staffCards.forEach(card => {
          getAccordions(card).forEach(d => { d.open = false; });
        });
      });
    }
  }

  // ---------------------------
  // Women's Health page: category accordion (premium feel)
  // Safe to run globally because it checks [data-faq]
  // ---------------------------
  (() => {
    const root = $('[data-faq]');
    if (!root) return;

    const items = $$('.faq-cat', root);

    items.forEach((wrap) => {
      const btn = wrap.querySelector('.faq-cat__header');
      const body = wrap.querySelector('.faq-cat__body');
      const icon = wrap.querySelector('.faq-cat__icon');
      if (!btn || !body) return;

      btn.addEventListener('click', () => {
        const expanded = btn.getAttribute('aria-expanded') === 'true';

        // close others
        items.forEach((w) => {
          const b = w.querySelector('.faq-cat__header');
          const bd = w.querySelector('.faq-cat__body');
          const ic = w.querySelector('.faq-cat__icon');
          if (!b || !bd) return;
          b.setAttribute('aria-expanded', 'false');
          bd.hidden = true;
          if (ic) ic.textContent = '+';
        });

        // toggle current
        btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
        body.hidden = expanded ? true : false;
        if (icon) icon.textContent = expanded ? '+' : '–';
      });
    });
  })();
})();

// PRIVACY: accordions (safe to run globally)
(function () {
  const root = document.querySelector('[data-privacy-acc-root]');
  if (!root) return;

  const items = Array.from(root.querySelectorAll('[data-privacy-acc]'));

  const syncIcon = (details) => {
    const icon = details.querySelector('.privacy-acc__icon');
    if (!icon) return;
    icon.textContent = details.open ? '–' : '+';
  };

  // initial
  items.forEach(syncIcon);

  items.forEach((details) => {
    details.addEventListener('toggle', () => {
      // close others (premium feel)
      if (details.open) {
        items.forEach((d) => {
          if (d !== details && d.open) d.open = false;
        });
      }
      items.forEach(syncIcon);
    });
  });
})();

// CONTACT FORM (Formspree) - safe to run globally
(() => {
  const form = document.querySelector('[data-contact-form]');
  if (!form) return;

  const submitBtn = form.querySelector('[data-contact-submit]');
  const errBox = form.querySelector('[data-contact-error]');
  const hp = form.querySelector('input[name="website"]');

  const msgRequired = form.getAttribute('data-i18n-required') || 'Please fill in all required fields.';
  const msgEmail = form.getAttribute('data-i18n-email') || 'Please enter a valid email address.';

  const showErr = (msg) => {
    if (!errBox) return;
    errBox.textContent = msg;
    errBox.hidden = false;
  };
  const clearErr = () => {
    if (!errBox) return;
    errBox.textContent = '';
    errBox.hidden = true;
  };

  form.addEventListener('submit', (e) => {
    clearErr();

    if (hp && hp.value.trim() !== '') {
      e.preventDefault();
      return;
    }

    const required = Array.from(form.querySelectorAll('[required]'));
    const missing = required.some((el) => !String(el.value || '').trim());
    if (missing) {
      e.preventDefault();
      showErr(msgRequired);
      return;
    }

    const email = form.querySelector('input[type="email"]');
    if (email) {
      const v = String(email.value || '').trim();
      const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
      if (!ok) {
        e.preventDefault();
        showErr(msgEmail);
        return;
      }
    }

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.style.opacity = '0.85';
    }
  });

  // If browser prevents submit, re-enable on input
  form.addEventListener('input', () => {
    if (submitBtn && submitBtn.disabled) {
      submitBtn.disabled = false;
      submitBtn.style.opacity = '';
    }
  });
})();

// ---------------------------
// Generic dropdowns (brochure, etc.)
// ---------------------------
(() => {
  const wraps = Array.from(document.querySelectorAll('[data-dd]'));
  if (!wraps.length) return;

  const closeAll = () => {
    wraps.forEach(w => {
      const menu = w.querySelector('[data-dd-menu]');
      const btn  = w.querySelector('[data-dd-toggle]');
      if (menu) menu.setAttribute('hidden', '');
      if (btn) btn.setAttribute('aria-expanded', 'false');
    });
  };

  wraps.forEach(w => {
    const btn  = w.querySelector('[data-dd-toggle]');
    const menu = w.querySelector('[data-dd-menu]');
    if (!btn || !menu) return;

    // start closed
    menu.setAttribute('hidden', '');
    btn.setAttribute('aria-expanded', 'false');

    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const open = menu.hasAttribute('hidden');
      closeAll();
      if (open) {
        menu.removeAttribute('hidden');
        btn.setAttribute('aria-expanded', 'true');
      }
    });

    // click outside
    document.addEventListener('click', (e) => {
      if (!w.contains(e.target)) {
        menu.setAttribute('hidden', '');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAll();
  });
})();