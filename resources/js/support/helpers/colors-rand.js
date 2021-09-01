

function Colors() {
  this.color = [];

  this.alpha(); // set default color type.
}

Colors.prototype.alpha = function () {
  const alphaColors = [
    'gray', 'red', 'orange', 'yellow', 'green', 'teal', 'blue', 'indigo', 'purple', 'pink'
  ];

  this.colors = alphaColors;

  return this;
}

Colors.prototype.random = function () {
  const rand = Math.floor( Math.random() * this.colors.length );

  return this.colors[rand];
}


export default new Colors();
