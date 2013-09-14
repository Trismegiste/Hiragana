voyel(a).
voyel(i).
voyel(u).
voyel(e).
voyel(o).

double(k).
double(p).
double(b).
double(t).
double(r).
double(s).

trans([X],X) :- voyel(X).

trans([k,a],ka).
trans([k,i],ki).
trans([k,u],ku).
trans([k,e],ke).
trans([k,o],ko).

trans([h,a],ha).
trans([h,i],hi).
trans([f,u],fu).
trans([h,e],he).
trans([h,o],ho).

trans([s,a],sa).
trans([s,h,i],shi).
trans([s,u],su).
trans([s,e],se).
trans([s,o],so).

trans([t,a],ta).
trans([c,h,i],chi).
trans([t,s,u],tsu).
trans([t,e],te).
trans([t,o],to).

trans([m,a],ma).
trans([m,i],mi).
trans([m,u],mu).
trans([m,e],me).
trans([m,o],mo).

trans([n,a],na).
trans([n,i],ni).
trans([n,u],nu).
trans([n,e],ne).
trans([n,o],no).

trans([r,a],ra).
trans([r,i],ri).
trans([r,u],ru).
trans([r,e],re).
trans([r,o],ro).

trans([y,a],ya).
trans([y,o],yo).
trans([y,u],yu).

trans([w,a],wa).
trans([w,o],wo).

trans([n],n).

trans([j,i], [shi,apo]).
trans([b,u], [fu,apo]).
trans([d,z,u], [tsu,apo]).
trans([g,V], [X,apo]) :- trans([k,V], X).
trans([z,V], [X,apo]) :- trans([s,V], X).
trans([d,V], [X,apo]) :- trans([t,V], X).
trans([b,V], [X,apo]) :- trans([h,V], X).

trans([p,u], [fu,ron]).
trans([p,V], [X,ron]) :- trans([h,V], X).

solve([],[]).
solve([C|[V|T]], [H|S]) :- trans([C,V], H) , solve(T, S).
solve([C|[C|[V|T]]], [[tsu,petit]|[H|S]]) :- double(C), trans([C,V], H) , solve(T, S).

solve([C|[y|[V|T]]], [K|[[Y,petit]|S]]) :- trans([C,i], K) , trans([y, V], Y) , solve(T, S).
solve([C1|[C2|[V|T]]], [H|S]) :- trans([C1,C2,V], H) , solve(T, S).
solve([C|[h|[V|T]]], [H|[[Y,petit]|S]]) :- trans([C,h,i], H) , trans([y, V], Y) , solve(T, S).

solve([V|T],[V|S]) :- voyel(V) , solve(T, S).
solve([n|[V|X]],Z) :- voyel(V) , ! , fail.
solve([n|T],[n|S]) :- solve(T, S).
