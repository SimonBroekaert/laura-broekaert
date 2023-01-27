import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-link-picker', IndexField)
  app.component('detail-link-picker', DetailField)
  app.component('form-link-picker', FormField)
})
