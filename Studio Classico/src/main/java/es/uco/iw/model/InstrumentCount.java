package es.uco.iw.model;

public class InstrumentCount {
	private int count;
	private Instrument instrument;
	
	public InstrumentCount(int count, Instrument instrument) {
		setCount(count);
		setInstrument(instrument);
	}
	
	public int getCount() {
		return count;
	}
	
	public Instrument getInstrument() {
		return instrument;
	}
	
	public void setCount(int count) {
		this.count = count;
	}

	public void setInstrument(Instrument instrument) {
		this.instrument = instrument;
	}
}
