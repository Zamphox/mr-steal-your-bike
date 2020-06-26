import ReportCase from './components/pages/ReportCase';
import Landing from "./components/pages/Landing";
import OfficerList from "./components/pages/OfficerList";

export const routes = [
    {
        name: 'landing',
        path: '/',
        component: Landing
    },
    {
        name: 'report_case',
        path: '/report-case',
        component: ReportCase
    },
    {
        name: 'officer_list',
        path: '/officer-list',
        component: OfficerList
    }
];
