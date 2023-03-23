import chaussures from '../fakeData.js';

export function getTime() {
  let today = new Date();
  let hours = today.getHours();
  let minutes = today.getMinutes();

  if (hours < 10) {
    hours = '0' + hours;
  }

  if (minutes < 10) {
    minutes = '0' + minutes;
  }

  let time = hours + ':' + minutes;
  return time;
}

export function getCategories(category) {
  const arrayOut = [...new Set(chaussures.map((c) => c[category]))];
  return arrayOut.join(', ');
}

export function getProducts(input, category) {
  let arrayOut = [];
  chaussures.forEach((element) => {
    if (element[category] === input) {
      arrayOut.push(element);
    }
  });
  return `Nous avons ${arrayOut.length} produits correspondant à cette demande : ${arrayOut.map((c) => c.nom).join(', ')}.`;
}