import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import FooterApp from './FooterApp'
import Checkbox from './Checkbox'
import Modal from './Modal'
import VbSwitch from 'vue-bulma-switch'
import { HasError, AlertError, AlertSuccess } from 'vform'


// Components that are registered globaly.
[
  Card,
  Modal,
  Child,
  Button,
  FooterApp,
  Checkbox,
  HasError,
  AlertError,
  AlertSuccess
].forEach(Component => {
  Vue.component(Component.name, Component)
});
Vue.component('VbSwitch', VbSwitch);

