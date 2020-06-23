import ReportCase from './components/pages/ReportCase';
import Landing from "./components/pages/Landing";

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
    }
];
