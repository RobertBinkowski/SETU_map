/**
 *  Title:          A Star
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Map } from "./map.js";

//Hard Coded Values
let rows = 5;
let cols = 5;
let height = 1;

let map = Map(rows, cols, height);

let start = map[0][0];
let end = map[cols - 1][rows - 1];

console.log(end.name);
