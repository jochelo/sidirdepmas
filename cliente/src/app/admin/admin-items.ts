export const adminItems = [
  {
    type: 'item',
    routerLink: '/',
    label: 'Inicio',
    icon: 'home',
    urlPermiso: 'dashboard'
  },
  {
    type: 'item',
    routerLink: '/admin/eventos-index',
    label: 'Eventos',
    icon: 'date_range',
    urlPermiso: 'eventos',
  },
  {
    type: 'item',
    routerLink: '/admin/persona-create',
    label: 'Registrar persona',
    icon: 'how_to_reg',
    urlPermiso: 'store-personas',
  },
];
