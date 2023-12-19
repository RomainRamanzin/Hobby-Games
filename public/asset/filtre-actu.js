function filterListByConsole(list, input) {
  let filteredList = [];
  for (let i = 0; i < list.length; i++) {
    let item = list[i];
    if (item["platforms"] == input) {
      filteredList.push(item);
    }
  }
  return filteredList;
}

const consoleInput = document.getElementById("console_filter");
consoleInput.addEventListener("change", function () {
  const results = filterListByConsole(list, this.value);
  //Logic for displaying the results goes here
});
