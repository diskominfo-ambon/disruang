function DateFormatter(value) {

  this.formatter = {
    locale: 'id-ID',
    options: {},
    value: typeof value === 'string'
      ? new Date(value)
      : value
  };

}


DateFormatter.prototype.toDate = function (style = Formatter.SHORT) {
  this.formatter.options = {
    ...this.formatter.options,
    dateStyle: style
  }

  return this;
}

DateFormatter.prototype.toTime = function (style = Formatter.SHORT) {
  this.formatter.options = {
    ...this.formatter.options,
    timeStyle: style
  }

  return this;
}

DateFormatter.prototype.locale = function (locale) {
  this.formatter.locale = locale;
}

DateFormatter.prototype.value = function () {
  const {
    locale,
    value,
    options
  } = this.formatter;

  return new Intl.DateTimeFormat(locale, options)
    .format(value);
}


export const Formatter = {
  FULL: 'full',
  SHORT: 'short',
  LONG: 'long'
}

export function format (value) {
  return new DateFormatter(value);
}
