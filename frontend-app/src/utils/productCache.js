class CacheService {
  constructor(ttl = 5 * 60 * 1000) {
    this.cache = new Map();
    this.ttl = ttl;
  }

  set(key, value) {
    this.cache.set(key, {
      value,
      timestamp: Date.now()
    });
  }

  get(key) {
    const item = this.cache.get(key);
    if (!item) return null;

    if (Date.now() - item.timestamp > this.ttl) {
      this.cache.clear();
      return null;
    }

    return item.value;
  }

  clear() {
    this.cache.clear();
  }
}

const productCache = new CacheService();
export default productCache; 