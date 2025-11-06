import app from 'flarum/admin/app';
import SettingsPage from './components/SettingsPage';

app.initializers.add('fof/default-user-preferences', () => {
  app.registry.for('fof-default-user-preferences').registerPage(SettingsPage);
});
