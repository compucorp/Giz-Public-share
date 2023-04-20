(() => {
  CRM.manageletterheads = CRM.manageletterheads || {};
  CRM.manageletterheads.letterhead_options = JSON.stringify([
    {
      id: '1',
      title: 'Letterhead (English)',
      name: 'letterhead-english',
      content: '<p>English Letterhead</p>',
      available_for: ['1', '2'],
      is_active: '1',
      weight: '1'
    },
    {
      id: '2',
      title: 'Letterhead (Welsh)',
      name: 'letterhead-welsh',
      content: '<p>Welsh Letterhead</p>',
      available_for: ['1', '2'],
      is_active: '1',
      weight: '2'
    },
    {
      id: '3',
      title: 'Letterhead (French)',
      name: 'letterhead-french',
      content: '<p>French Letterhead</p>',
      available_for: ['1', '2'],
      is_active: '1',
      weight: '3'
    }
  ]);
})();
