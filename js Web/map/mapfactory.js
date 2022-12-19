// Title:       SETU Map
// By:          Robert Binkowski
// Code:        C00237917
// Tutor:       Oisin Cawley

function MapFactory() {
  this.maps = [];
  this.maps.push(SearchMap); // Simple random map

  this.getMap = function (
    cols,
    rows,
    x,
    y,
    w,
    h,
    allowDiagonals,
    percentWalls
  ) {
    if (this.maps.length == 0) return undefined;

    var selected = floor(random(this.maps.length));
    return new this.maps[selected](
      cols,
      rows,
      x,
      y,
      w,
      h,
      allowDiagonals,
      percentWalls
    );
  };
}
