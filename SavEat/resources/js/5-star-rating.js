class StarRating {
  constructor(element) {
    this.element = element;
    this.starsContainer = element.querySelector('.stars-container');
    this.starsForeground = element.querySelector('.stars-foreground');
    this.ratingValue = element.querySelector('.rating-value');
    this.totalStars = 5;
    this.init();
  }

  init() {
    this.starsContainer.addEventListener('mousemove', (e) => this.handleMouseMove(e));
    this.starsContainer.addEventListener('mouseleave', () => this.handleMouseLeave());
    this.starsContainer.addEventListener('click', (e) => this.handleClick(e));
  }

  calculateRating(e) {
    const rect = this.starsContainer.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const percent = (x / rect.width) * 100;

    // Convert to 0.5 steps
    let rating = Math.round((percent / 100) * this.totalStars * 2) / 2;
    // Ensure minimum of 0.5 and maximum of 5
    rating = Math.max(0.5, Math.min(5, rating));

    return {
        rating,
        percent: (rating / this.totalStars) * 100
    };
  }

  handleMouseMove(e) {
    const { rating, percent } = this.calculateRating(e);
    this.starsForeground.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
    this.ratingValue.textContent = rating;
  }

  handleMouseLeave() {
    const currentRating = this.element.dataset.rating || 0;
    const percent = (currentRating / 5) * 100;
    this.starsForeground.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
    this.ratingValue.textContent = currentRating;
  }

  handleClick(e) {
    const { rating, percent } = this.calculateRating(e);
    this.element.dataset.rating = rating;
    this.starsForeground.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
    this.ratingValue.textContent = rating;

    this.element.dispatchEvent(new CustomEvent('rating-changed', {
        detail: { rating }
    }));
  }

  // Read-only mode
  setReadOnly(readonly = true) {
    this.starsContainer.style.pointerEvents = readonly ? 'none' : 'auto';
    this.element.classList.toggle('readonly', readonly);
  }

  // Set rating programmatically
  setRating(rating) {
    rating = Math.max(0.5, Math.min(5, rating));
    const percent = (rating / 5) * 100;
    this.element.dataset.rating = rating;
    this.starsForeground.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
    this.ratingValue.textContent = rating;
  }

  // Clear rating
  clearRating() {
    delete this.element.dataset.rating;
    this.starsForeground.style.clipPath = 'inset(0 100% 0 0)';
    this.ratingValue.textContent = '0';
  }
}

// Initialize
document.querySelectorAll('.star-rating').forEach(element => {
  new StarRating(element);
});
