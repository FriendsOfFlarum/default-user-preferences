import app from 'flarum/admin/app';
import ExtensionPage from 'flarum/admin/components/ExtensionPage';
import ItemList from 'flarum/common/utils/ItemList';
import type Mithril from 'mithril';

export default class SettingsPage extends ExtensionPage {
  content() {
    return (
      <div className="FoFDefaultPreferencesSettingsPage">
        <div className="container">
          <div className="Form-group">
            {this.defaultSettingsItems().toArray()}
            {this.submitButton()}
          </div>
        </div>
      </div>
    );
  }

  defaultSettingsItems() {
    const items = new ItemList<Mithril.Children>();

    const prefix = 'fof-default-user-preferences.';

    app.forum.attribute('fof-default-user-preferences').forEach((pref: string) => {
      items.add(
        pref,
        this.buildSettingComponent({
          label: app.translator.trans(`fof-default-user-preferences.admin.settings.${pref}`),
          help: app.translator.trans(`fof-default-user-preferences.admin.settings.${pref}-help`),
          setting: prefix + pref,
          type: 'boolean',
        })
      );
    });

    return items;
  }
}
