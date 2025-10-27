
import Inspector from './inspector';
import Toolbar from './toolbar';
import Markup from './markup';

export default (props) => (
	<>
		<Toolbar {...props}/>
		<Inspector {...props}/>
		<Markup {...props}/>
	</>
);
