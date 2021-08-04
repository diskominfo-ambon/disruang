export function formatter (locale = 'id-ID') {
  return {
    date(date) {
      return new Intl.DateTimeFormat(locale, { timeStyle: 'short', dateStyle: 'long' })
        .format(date);
    },

    time(time) {
      return new Intl.DateTimeFormat(locale, { timeStyle: 'long'})
        .format(time)
        .replaceAll('.', ':');
    },

    full(date) {
      return new Intl.DateTimeFormat(locale, { timeStyle: 'short', dateStyle: 'long' })
        .format(date)
        .replaceAll('.', ':')
    }
  }
}
