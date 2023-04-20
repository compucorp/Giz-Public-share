(($) => {
  const onReadyListeners = [];

  $.fn.ready = (onReadyListener) => {
    onReadyListeners.push(onReadyListener);
  };

  $.fn.triggerBlockedOnReadyListeners = () => {
    onReadyListeners.forEach(onReadyListener => onReadyListener());
  };
})(CRM.$);
