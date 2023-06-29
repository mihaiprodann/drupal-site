// js/script.js
(function (Drupal, once) {
  Drupal.behaviors.script = {
    attach(context) {
      const elements = once('script', '.test', context);
      elements.forEach((value, index) => {
        value.addEventListener('click', () => {
          alert("test");
        });
      });
    }
  };

}(Drupal, once));
